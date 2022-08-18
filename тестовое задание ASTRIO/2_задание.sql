
SELECT last_name, first_name, group_concat(' ',name) AS child, model
FROM astrio.worker, astrio.child, astrio.car
where (worker.id = child.user_id and worker.id = car.user_id)
GROUP BY last_name, first_name;
