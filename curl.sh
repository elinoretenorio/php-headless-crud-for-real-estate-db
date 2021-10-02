curl -X GET "localhost:8080/admin"

curl -X POST "localhost:8080/admin" -H 'Content-Type: application/json' -d'
{
  "admin_address": "wide",
  "admin_contact": "inside",
  "admin_email": "lawrence37@example.net",
  "admin_name": "nice",
  "password": "evidence",
  "username": "later"
}
'

curl -X POST "localhost:8080/admin/7733" -H 'Content-Type: application/json' -d'
{
  "admin_address": "wide",
  "admin_contact": "inside",
  "admin_email": "lawrence37@example.net",
  "admin_id": 7733,
  "admin_name": "nice",
  "password": "evidence",
  "username": "later"
}
'

curl -X GET "localhost:8080/admin/7733"

curl -X DELETE "localhost:8080/admin/7733"

# --

curl -X GET "localhost:8080/agents"

curl -X POST "localhost:8080/agents" -H 'Content-Type: application/json' -d'
{
  "agent_address": "east",
  "agent_contact": "serve",
  "agent_email": "emorales@example.net",
  "agent_fb_account": "free",
  "agent_image": "Population bank large.",
  "agent_name": "point",
  "password": "minute",
  "username": "deal"
}
'

curl -X POST "localhost:8080/agents/2415" -H 'Content-Type: application/json' -d'
{
  "agent_address": "east",
  "agent_contact": "serve",
  "agent_email": "emorales@example.net",
  "agent_fb_account": "free",
  "agent_id": 2415,
  "agent_image": "Population bank large.",
  "agent_name": "point",
  "password": "minute",
  "username": "deal"
}
'

curl -X GET "localhost:8080/agents/2415"

curl -X DELETE "localhost:8080/agents/2415"

# --

curl -X GET "localhost:8080/appointments"

curl -X POST "localhost:8080/appointments" -H 'Content-Type: application/json' -d'
{
  "admin_id": 4806,
  "agent_id": 8748,
  "appointment_date": "2021-09-19",
  "appointment_description": "especially",
  "appointment_status": 2035,
  "client_id": 3100
}
'

curl -X POST "localhost:8080/appointments/3947" -H 'Content-Type: application/json' -d'
{
  "admin_id": 4806,
  "agent_id": 8748,
  "appointment_date": "2021-09-19",
  "appointment_description": "especially",
  "appointment_id": 3947,
  "appointment_status": 2035,
  "client_id": 3100
}
'

curl -X GET "localhost:8080/appointments/3947"

curl -X DELETE "localhost:8080/appointments/3947"

# --

curl -X GET "localhost:8080/clients"

curl -X POST "localhost:8080/clients" -H 'Content-Type: application/json' -d'
{
  "client_address": "often",
  "client_contact": "like",
  "client_email": "megananderson@example.net",
  "client_fb_account": "reflect",
  "client_image": "Important change seem may.",
  "client_name": "enter",
  "password": "position",
  "username": "tough"
}
'

curl -X POST "localhost:8080/clients/6648" -H 'Content-Type: application/json' -d'
{
  "client_address": "often",
  "client_contact": "like",
  "client_email": "megananderson@example.net",
  "client_fb_account": "reflect",
  "client_id": 6648,
  "client_image": "Important change seem may.",
  "client_name": "enter",
  "password": "position",
  "username": "tough"
}
'

curl -X GET "localhost:8080/clients/6648"

curl -X DELETE "localhost:8080/clients/6648"

# --

curl -X GET "localhost:8080/comments"

curl -X POST "localhost:8080/comments" -H 'Content-Type: application/json' -d'
{
  "admin_id": 5602,
  "client_id": 4187,
  "comment": "week",
  "comment_date": "2021-09-22",
  "comment_status": 6017,
  "comment_time": "2021-10-09 06:26:27",
  "property_id": 2364
}
'

curl -X POST "localhost:8080/comments/126" -H 'Content-Type: application/json' -d'
{
  "admin_id": 5602,
  "client_id": 4187,
  "comment": "week",
  "comment_date": "2021-09-22",
  "comment_id": 126,
  "comment_status": 6017,
  "comment_time": "2021-10-09 06:26:27",
  "property_id": 2364
}
'

curl -X GET "localhost:8080/comments/126"

curl -X DELETE "localhost:8080/comments/126"

# --

curl -X GET "localhost:8080/notifications"

curl -X POST "localhost:8080/notifications" -H 'Content-Type: application/json' -d'
{
  "admin_id": 4776,
  "notification_description": "mean",
  "notification_name": "look"
}
'

curl -X POST "localhost:8080/notifications/5887" -H 'Content-Type: application/json' -d'
{
  "admin_id": 4776,
  "notification_description": "mean",
  "notification_id": 5887,
  "notification_name": "look"
}
'

curl -X GET "localhost:8080/notifications/5887"

curl -X DELETE "localhost:8080/notifications/5887"

# --

curl -X GET "localhost:8080/properties"

curl -X POST "localhost:8080/properties" -H 'Content-Type: application/json' -d'
{
  "agent_id": 8208,
  "description": "skin",
  "price": 708.0,
  "property_name": "stay",
  "property_status": 9044,
  "property_type_id": 5845
}
'

curl -X POST "localhost:8080/properties/8742" -H 'Content-Type: application/json' -d'
{
  "agent_id": 8208,
  "description": "skin",
  "price": 708.0,
  "property_id": 8742,
  "property_name": "stay",
  "property_status": 9044,
  "property_type_id": 5845
}
'

curl -X GET "localhost:8080/properties/8742"

curl -X DELETE "localhost:8080/properties/8742"

# --

curl -X GET "localhost:8080/property-images"

curl -X POST "localhost:8080/property-images" -H 'Content-Type: application/json' -d'
{
  "image_description": "home",
  "image_name": "feel",
  "property_id": 2678
}
'

curl -X POST "localhost:8080/property-images/6191" -H 'Content-Type: application/json' -d'
{
  "image_description": "home",
  "image_name": "feel",
  "property_id": 2678,
  "property_image_id": 6191
}
'

curl -X GET "localhost:8080/property-images/6191"

curl -X DELETE "localhost:8080/property-images/6191"

# --

