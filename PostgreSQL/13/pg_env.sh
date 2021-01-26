#!/bin/sh
# The script sets environment variables helpful for PostgreSQL

export PATH=/Library/PostgreSQL/13/bin:$PATH
export PGDATA=/Library/PostgreSQL/13/data
export PGDATABASE=postgres
export PGUSER=postgres
export PGPORT=5432
export PGLOCALEDIR=/Library/PostgreSQL/13/share/locale
export MANPATH=$MANPATH:/Library/PostgreSQL/13/share/man

                            