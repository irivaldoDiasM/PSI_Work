#!/bin/bash
#
# Authors: Nuno Antunes <nmsa@dei.uc.pt>
#

image="ddss_db"
container="db"



docker stop $container
docker rm $container