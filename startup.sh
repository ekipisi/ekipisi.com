#!/usr/bin/env bash
find . -type f -name '*.DS_Store' -ls -delete
find storage/framework -type f -name '*' -ls -delete
find storage/framework/cache -type d -name '*' -ls -delete
find storage/debugbar -type f -name '*' -ls -delete
# find storage/logs -type f -name '*' -ls -delete

# composer update --no-dev