SELECT
  order_detail_table.order_id,
  order_table.order_date,
  customer_table.customer_name,
  customer_table.address,
  customer_table.phone_number,
  order_table.payment,
  goods_table.goods_name,
  goods_table.price,
  order_detail_table.quantity
FROM order_detail_table
JOIN order_table ON order_detail_table.order_id=order_table.order_id
JOIN customer_table ON order_table.customer_id=customer_table.customer_id
JOIN goods_table ON order_detail_table.goods_id=goods_table.goods_id
;

SELECT
  order_detail_table.order_id,
  order_table.order_date,
  customer_table.customer_name,
  goods_table.goods_name,
  goods_table.price,
  order_detail_table.quantity
FROM order_detail_table
JOIN order_table ON order_detail_table.order_id=order_table.order_id
JOIN customer_table ON order_table.customer_id=customer_table.customer_id
JOIN goods_table ON order_detail_table.goods_id=goods_table.goods_id
WHERE customer_table.customer_name='佐藤一郎'
;

SELECT
  goods_table.goods_name,
  goods_table.price,
  order_detail_table.quantity,
  order_table.order_date
FROM order_detail_table
JOIN order_table ON order_detail_table.order_id=order_table.order_id
JOIN customer_table ON order_table.customer_id=customer_table.customer_id
JOIN goods_table ON order_detail_table.goods_id=goods_table.goods_id
WHERE goods_table.goods_name='コーラ'
;

SELECT
  goods_table.goods_name,
  goods_table.price,
  order_detail_table.quantity,
  order_table.order_date
FROM order_detail_table
JOIN order_table ON order_detail_table.order_id=order_table.order_id
JOIN customer_table ON order_table.customer_id=customer_table.customer_id
RIGHT JOIN goods_table ON order_detail_table.goods_id=goods_table.goods_id
ORDER BY order_detail_table.quantity DESC
;