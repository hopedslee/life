cd C:\Bitnami\wampstack-7.4.12-0\mysql\bin

mysqldump -h 192.168.0.99 -u dslee -pA2lds7707! dslee_db acctlog > E:\DATA\Database\acctlog.sql
mysqldump -h 192.168.0.99 -u dslee -pA2lds7707! dslee_db client_log > E:\DATA\Database\client_log.sql
mysqldump -h 192.168.0.99 -u dslee -pA2lds7707! dslee_db customers > E:\DATA\Database\customers.sql
mysqldump -h 192.168.0.99 -u dslee -pA2lds7707! dslee_db ea_heartbeat > E:\DATA\Database\ea_heartbeat.sql       
mysqldump -h 192.168.0.99 -u dslee -pA2lds7707! dslee_db myevents > E:\DATA\Database\myevents.sql  
mysqldump -h 192.168.0.99 -u dslee -pA2lds7707! dslee_db ordershistory > E:\DATA\Database\ordershistory.sql      
mysqldump -h 192.168.0.99 -u dslee -pA2lds7707! dslee_db sangrok > E:\DATA\Database\sangrok.sql
mysqldump -h 192.168.0.99 -u dslee -pA2lds7707! dslee_db settlement > E:\DATA\Database\settlement.sql
mysqldump -h 192.168.0.99 -u dslee -pA2lds7707! dslee_db trlog > E:\DATA\Database\trlog.sql

C:\Bitnami\wampstack-7.4.12-0\mysql\bin\mysql -u dslee -pA2lds7707! dslee_db < E:\DATA\Database\acctlog.sql
C:\Bitnami\wampstack-7.4.12-0\mysql\bin\mysql -u dslee -pA2lds7707! dslee_db < E:\DATA\Database\client_log.sql
C:\Bitnami\wampstack-7.4.12-0\mysql\bin\mysql -u dslee -pA2lds7707! dslee_db < E:\DATA\Database\ea_heartbeat.sql
C:\Bitnami\wampstack-7.4.12-0\mysql\bin\mysql -u dslee -pA2lds7707! dslee_db < E:\DATA\Database\ordershistory.sql
C:\Bitnami\wampstack-7.4.12-0\mysql\bin\mysql -u dslee -pA2lds7707! dslee_db < E:\DATA\Database\settlement.sql
C:\Bitnami\wampstack-7.4.12-0\mysql\bin\mysql -u dslee -pA2lds7707! dslee_db < E:\DATA\Database\trlog.sql
C:\Bitnami\wampstack-7.4.12-0\mysql\bin\mysql -u dslee -pA2lds7707! dslee_db < E:\DATA\Database\myevents.sql
C:\Bitnami\wampstack-7.4.12-0\mysql\bin\mysql -u dslee -pA2lds7707! dslee_db < E:\DATA\Database\sangrok.sql
C:\Bitnami\wampstack-7.4.12-0\mysql\bin\mysql -u dslee -pA2lds7707! dslee_db < E:\DATA\Database\ypagri21.sql
