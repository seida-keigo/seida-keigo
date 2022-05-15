SELECT
  customer_table.customer_name,
  COUNT(customer_table.customer_name)AS 発注回数
FROM order_table
LEFT JOIN customer_table ON order_table.customer_id=customer_table.customer_id
GROUP BY customer_table.customer_name
;

SELECT
  goods_table.goods_name,
  SUM(order_detail_table.quantity)AS 売上数量
FROM order_detail_table
JOIN goods_table ON order_detail_table.goods_id=goods_table.goods_id
WHERE goods_table.price=100
GROUP BY goods_table.goods_name
;

SELECT
  customer_table.customer_name,
  SUM(order_detail_table.quantity*goods_table.price)AS 合計金額
FROM order_detail_table
JOIN order_table ON order_detail_table.order_id=order_table.order_id
LEFT JOIN customer_table ON order_table.customer_id=customer_table.customer_id
JOIN goods_table ON order_detail_table.goods_id=goods_table.goods_id
GROUP BY customer_table.customer_name
;