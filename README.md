"# Vidalytics" 

All DB credentials are please in class Model/Database 

The basket calculation are done inside the SQL query and after that optimized (calculated offers and cost of the delivery).
Table offers consis of the offers:
code - for which product this offer is created
amount - how many products I have to buy to get the offer
discount - discont on the price for the next product from the same category

The application supports four API calls:

Adding product to the DB
url : index.php/product/add
method: POST
data:
{
"name": "Red Widget",
"code": "R01",
"price": 32.95
}

Gets all products from DB
url : index.php/product/list
method: GET
output:
[
{
"id": 1,
"name": "Red Widget",
"code": "R01",
"price": 32.95
},
{
"id": 2,
"name": "Green Widget",
"code": "G01",
"price": 24.95
},
{
"id": 3,
"name": "Blue Widget",
"code": "B01",
"price": 7.95
}
]


Gets all baskets from DB
url : index.php/basket/list
method: GET
output:
[
{
"id": 1,
"price": 32.90000057220459,
"products": "B01, G01",
"delivery": 4.95,
"total": 37.85000057220459
},
{
"id": 2,
"price": 49.425001525878905,
"products": "R01, R01",
"delivery": 4.95,
"total": 54.37500152587891
},
{
"id": 3,
"price": 57.900001525878906,
"products": "G01, R01",
"delivery": 2.95,
"total": 60.85000152587891
},
{
"id": 4,
"price": 98.27500190734864,
"products": "B01, B01, R01, R01, R01",
"delivery": 0,
"total": 98.27500190734864
}
]