#!/usr/bin/env bash
set -euo pipefail

# Deploy local website to mounted UNIPG directory via rsync.
# Modes: --mount, --umount, --start, --stop, --sync, --sync-dry, --git-pull, --git-push, --git-commit.

SRC_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)/"
DST_DIR="${HOME}/mnt/unipg/"
MODE=""
SERVE_HOST="127.0.0.1"
SERVE_PORT="8000"
PID_FILE="${SRC_DIR}.php-server.pid"
LOG_FILE="${SRC_DIR}.php-server.log"
REMOTE_USER="vm-10-fb830047"
REMOTE_HOST="sftp.sites.dmi.unipg.it"
REMOTE_PATH="/home/gear-lab/public_html"
COMMIT_MSG=""

usage() {
  echo "Usage: $0 [--mount|--umount|--start|--stop|--sync|--sync-dry|--git-pull|--git-push|--git-commit] [--msg <message>] [--port <port>]"
}

is_server_running() {
  [[ -f "${PID_FILE}" ]] || return 1
  local pid
  pid="$(cat "${PID_FILE}" 2>/dev/null || true)"
  [[ -n "${pid}" ]] || return 1
  kill -0 "${pid}" 2>/dev/null
}

while [[ $# -gt 0 ]]; do
  case "$1" in
    --start)
      MODE="start"
      ;;
    --stop)
      MODE="stop"
      ;;
    --mount)
      MODE="mount"
      ;;
    --umount)
      MODE="umount"
      ;;
    --sync)
      MODE="sync"
      ;;
    --sync-dry|--synch-dry)
      MODE="sync-dry"
      ;;
    --git-pull|--pull)
      MODE="git-pull"
      ;;
    --git-push|--push)
      MODE="git-push"
      ;;
    --git-commit|--commit)
      MODE="git-commit"
      ;;
    --msg|-m)
      if [[ -z "${2:-}" ]]; then
        usage
        exit 1
      fi
      COMMIT_MSG="$2"
      shift
      ;;
    --port)
      if [[ -z "${2:-}" ]]; then
        usage
        exit 1
      fi
      SERVE_PORT="$2"
      shift
      ;;
    -h|--help)
      usage
      exit 0
      ;;
    *)
      usage
      exit 1
      ;;
  esac
  shift
done

if [[ -z "${MODE}" ]]; then
  usage
  exit 1
fi

if [[ "${MODE}" == "mount" ]]; then
  mkdir -p "${DST_DIR}"
  if mountpoint -q "${DST_DIR}"; then
    echo "Already mounted: ${DST_DIR}"
    exit 0
  fi
  echo "[MOUNT] ${REMOTE_USER}@${REMOTE_HOST}:${REMOTE_PATH} -> ${DST_DIR}"
  sshfs "${REMOTE_USER}@${REMOTE_HOST}:${REMOTE_PATH}" "${DST_DIR}"
  echo "Mounted."
  exit 0
fi

if [[ "${MODE}" == "umount" ]]; then
  if ! mountpoint -q "${DST_DIR}"; then
    echo "Not mounted: ${DST_DIR}"
    exit 0
  fi
  echo "[UMOUNT] ${DST_DIR}"
  fusermount -u "${DST_DIR}"
  echo "Unmounted."
  exit 0
fi

if [[ "${MODE}" == "start" ]]; then
  if is_server_running; then
    echo "PHP server already running (PID $(cat "${PID_FILE}"))."
    echo "URL: http://${SERVE_HOST}:${SERVE_PORT}"
    exit 0
  fi

  echo "[START] Starting PHP dev server on http://${SERVE_HOST}:${SERVE_PORT}"
  cd "${SRC_DIR}"
  nohup php -S "${SERVE_HOST}:${SERVE_PORT}" > "${LOG_FILE}" 2>&1 &
  echo $! > "${PID_FILE}"
  echo "Started (PID $(cat "${PID_FILE}")). Log: ${LOG_FILE}"
  exit 0
fi

if [[ "${MODE}" == "stop" ]]; then
  if ! is_server_running; then
    rm -f "${PID_FILE}"
    echo "PHP server is not running."
    exit 0
  fi

  pid="$(cat "${PID_FILE}")"
  echo "[STOP] Stopping PHP dev server (PID ${pid})"
  kill "${pid}" 2>/dev/null || true
  sleep 0.3
  if kill -0 "${pid}" 2>/dev/null; then
    kill -9 "${pid}" 2>/dev/null || true
  fi
  rm -f "${PID_FILE}"
  echo "Stopped."
  exit 0
fi

if [[ "${MODE}" == "git-pull" ]]; then
  echo "[GIT-PULL] Running git pull in ${SRC_DIR}"
  cd "${SRC_DIR}"
  git pull
  exit 0
fi

if [[ "${MODE}" == "git-push" ]]; then
  echo "[GIT-PUSH] Running git push in ${SRC_DIR}"
  cd "${SRC_DIR}"
  git push
  exit 0
fi

if [[ "${MODE}" == "git-commit" ]]; then
  if [[ -z "${COMMIT_MSG}" ]]; then
    echo "Missing commit message. Use --msg \"your message\""
    exit 1
  fi
  echo "[GIT-COMMIT] Running git commit in ${SRC_DIR}"
  cd "${SRC_DIR}"
  git commit -m "${COMMIT_MSG}"
  exit 0
fi

if [[ ! -d "${DST_DIR}" ]]; then
  echo "Destination directory not found: ${DST_DIR}"
  echo "Mount first (example): mountgear"
  exit 1
fi

COMMON_ARGS=(
  -rltDzv
  --delete
  --no-owner
  --no-group
  --no-perms
  --chmod=Du=rwx,Dgo=rx,Fu=rw,Fgo=r
  --exclude='.git/'
  --exclude='.codex-project-id'
  --exclude='.gitignore'
  --exclude='LICENSE'
  --exclude='README.md'
  --exclude='.php-server.log'
  --exclude='.php-server.pid'
  --exclude='deploy_unipg.sh'
)

if [[ "${MODE}" != "sync" && "${MODE}" != "sync-dry" ]]; then
  usage
  exit 1
fi

if [[ "${MODE}" == "sync-dry" ]]; then
  echo "[SYNC-DRY] Preview from ${SRC_DIR} to ${DST_DIR}"
  rsync "${COMMON_ARGS[@]}" --dry-run "${SRC_DIR}" "${DST_DIR}"
  echo "No files were changed."
else
  echo "[SYNC] Syncing from ${SRC_DIR} to ${DST_DIR}"
  rsync "${COMMON_ARGS[@]}" "${SRC_DIR}" "${DST_DIR}"
  echo "Sync completed."
fi
