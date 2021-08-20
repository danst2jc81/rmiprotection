
SELECT * FROM acct_account_type

DELETE FROM data_perpetrator

DELETE FROM data_perpetrator_photo

DELETE FROM data_perpetrator_chronology

SELECT * FROM migrasi_customer

UPDATE migrasi_customer, core_city SET migrasi_customer.province_id = core_city.province_id,
					migrasi_customer.city_id = core_city.city_id
					WHERE migrasi_customer.city_name = core_city.city_name
					
SELECT * FROM sales_customer

INSERT INTO sales_customer (province_id, city_id, package_id, package_price_id, 
	customer_name, customer_email, customer_mobile_phone, customer_mobile_phone1, 
	customer_unit, customer_registration_date, customer_status,
	package_status, customer_package_status, customer_package_date, customer_last_date, 
	customer_package_search_balance, customer_package_add_balance, customer_package_balance_status)
	SELECT province_id, city_id, 1, 1, 
	customer_name, customer_email, customer_mobile_phone, customer_mobile_phone1, 
	customer_unit, CURDATE(), 1,
	2, 1, CURDATE(), '2021-09-17', 
	100, 100, 1
	FROM migrasi_customer
	
UPDATE migrasi_customer, sales_customer SET migrasi_customer.customer_id = sales_customer.customer_id
	WHERE migrasi_customer.customer_email = sales_customer.customer_email
	
SELECT * FROM SYSTEM_USER

INSERT INTO SYSTEM_USER (user_group_id, customer_id, package_id, package_price_id, province_id, 
	city_id, customer_email, customer_password, customer_name, customer_mobile_phone, customer_status)
	SELECT 2, customer_id, 1, 1, province_id, 
	city_id, customer_email, MD5("123456"), customer_name, customer_mobile_phone, 1
	FROM migrasi_customer
	
	
SELECT * FROM migrasi_customer2

UPDATE migrasi_customer2, core_city SET migrasi_customer2.province_id = core_city.province_id,
					migrasi_customer2.city_id = core_city.city_id
					WHERE migrasi_customer2.city_name = core_city.city_name;

SELECT * FROM sales_customer

INSERT INTO sales_customer (province_id, city_id, package_id, package_price_id, 
	customer_name, customer_email, customer_mobile_phone, customer_mobile_phone1, customer_unit, 
	customer_registration_date, customer_status, package_status, customer_last_date, customer_package_status,
	customer_package_date, customer_package_search_balance, customer_package_add_balance, 
	customer_package_balance_status)
	SELECT province_id, city_id, 1, 1, 
	customer_name, customer_email, customer_mobile_phone, customer_mobile_phone1, customer_unit, 
	CURDATE(), 1, 2, '2021-09-17', 1,
	CURDATE(), 100, 100, 
	1
	FROM migrasi_customer2
	
UPDATE migrasi_customer2, sales_customer SET migrasi_customer2.customer_id = sales_customer.customer_id
	WHERE migrasi_customer2.customer_email = sales_customer.customer_email
	
SELECT * FROM migrasi_customer2

SELECT * FROM SYSTEM_USER

INSERT INTO SYSTEM_USER (user_group_id, customer_id, package_id, package_price_id, 
	province_id, city_id, customer_email, customer_password, customer_name, customer_mobile_phone, 
	customer_status)
	SELECT 2, customer_id, 1, 1, 
	province_id, city_id, customer_email, MD5("123456"), customer_name, customer_mobile_phone, 
	1
	FROM migrasi_customer2
	
	
GELOMBANG 3

UPDATE migrasi_customer3, core_city SET migrasi_customer3.province_id = core_city.province_id,
					migrasi_customer3.city_id = core_city.city_id
					WHERE migrasi_customer3.city_name = core_city.city_name;

SELECT * FROM sales_customer

INSERT INTO sales_customer (province_id, city_id, package_id, package_price_id, 
	customer_name, customer_email, customer_mobile_phone, customer_mobile_phone1, customer_unit, 
	customer_registration_date, customer_status, package_status, customer_last_date, customer_package_status,
	customer_package_date, customer_package_search_balance, customer_package_add_balance, 
	customer_package_balance_status)
	SELECT province_id, city_id, 1, 1, 
	customer_name, customer_email, customer_mobile_phone, customer_mobile_phone1, customer_unit, 
	CURDATE(), 1, 2, '2021-09-17', 1,
	CURDATE(), 100, 100, 
	1
	FROM migrasi_customer3
	
UPDATE migrasi_customer3, sales_customer SET migrasi_customer3.customer_id = sales_customer.customer_id
	WHERE migrasi_customer3.customer_email = sales_customer.customer_email
	
SELECT * FROM migrasi_customer2

SELECT * FROM SYSTEM_USER

INSERT INTO SYSTEM_USER (user_group_id, customer_id, package_id, package_price_id, 
	province_id, city_id, customer_email, customer_password, customer_name, customer_mobile_phone, 
	customer_status)
	SELECT 2, customer_id, 1, 1, 
	province_id, city_id, customer_email, MD5("123456"), customer_name, customer_mobile_phone, 
	1
	FROM migrasi_customer3
	
	
	
MIGRASI CUSTOMER 4

UPDATE migrasi_customer4, core_city SET migrasi_customer4.province_id = core_city.province_id,
					migrasi_customer4.city_id = core_city.city_id
					WHERE migrasi_customer4.city_name = core_city.city_name;
					
select * from migrasi_customer4
					
INSERT INTO sales_customer (province_id, city_id, package_id, package_price_id, 
	customer_name, customer_contact_person, customer_email, customer_mobile_phone, customer_mobile_phone1, customer_unit, 
	customer_registration_date, customer_status, package_status, customer_last_date, customer_package_status,
	customer_package_date, customer_package_search_balance, customer_package_add_balance, 
	customer_package_balance_status)
	SELECT province_id, city_id, 1, 1, 
	customer_name, customer_contact_person, customer_email, customer_mobile_phone, customer_mobile_phone1, customer_unit, 
	CURDATE(), 1, 2, '2021-09-17', 1,
	CURDATE(), 100, 100, 
	1
	FROM migrasi_customer4
	
UPDATE migrasi_customer4, sales_customer SET migrasi_customer4.customer_id = sales_customer.customer_id
	WHERE migrasi_customer4.customer_email = sales_customer.customer_email
	
SELECT * FROM migrasi_customer2

SELECT * FROM SYSTEM_USER

INSERT INTO SYSTEM_USER (user_group_id, customer_id, package_id, package_price_id, 
	province_id, city_id, customer_email, customer_password, customer_name, customer_mobile_phone, 
	customer_status)
	SELECT 2, customer_id, 1, 1, 
	province_id, city_id, customer_email, MD5("123456"), customer_name, customer_mobile_phone, 
	1
	FROM migrasi_customer4