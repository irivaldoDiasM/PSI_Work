#
# Authors: Nuno Antunes <nmsa@dei.uc.pt>
#

FROM library/postgres


ENV POSTGRES_USER ss-db-a1
ENV POSTGRES_PASSWORD ss-db-a1
ENV POSTGRES_DB ss-db-a1

COPY ddss-db-schema-pg.sql /docker-entrypoint-initdb.d/

EXPOSE 5432
