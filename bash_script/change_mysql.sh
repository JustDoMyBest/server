#!/bin/bash


/usr/bin/mysql -h10.3.0.253 -uroot -padminpw123 -e "ALTER TABLE OMS.ej_order_per_printmould CHANGE customs_id customs_id INT(11) NOT NULL COMMENT '报关订单索引id';"
