for d in ./*/ ;
do
  (cd "$d" ;  docker-compose up -d; cd ..);
done
