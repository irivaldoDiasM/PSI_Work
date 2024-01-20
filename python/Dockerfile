#
# Authors: Nuno Antunes <nmsa@dei.uc.pt>
#

from python:3.8-alpine

RUN apk update && apk add postgresql-dev gcc python3-dev musl-dev

run pip install flask==2.2.2 

run pip install psycopg2-binary


# Acabei de alterar
run pip install bcrypt


copy . /app

volume ["/app"]

workdir /app

run mkdir -p logs

EXPOSE 5000

CMD ["python", "app.py"]
