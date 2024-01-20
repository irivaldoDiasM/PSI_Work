#!/bin/bash
#
# Authors: Nuno Antunes <nmsa@dei.uc.pt>
#

image="unicv_ss_a1-base-v3-db"
container="unicv_ss_a1-base-v3-db"



echo "-- Building --"
docker   build  -t  $image   .
