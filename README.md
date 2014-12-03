OrderFulfillment
================
Our Order Fulfillment client: http://128.199.132.197/dntk/ <br>
Username: test@test.com <br>
Password: 1q2w3e4r5t <br>

<h3>Description</h3>
---

A service for order fulfillment. The order fulfiller will validate the order if it is in stock and available for ordering or not. Approve the order for the customer and track the order as well. Given service of viewing and tracking the order as well as its components until the process of ordering is finished.

<h3>Concept</h3>
---

Order Fulfillment describes everything the seller does from the moment the order has been placed to the event where the purchased order is in the buyer's hand. Includes the process of receiving products to sell, storing products, and providing controls of inventory.

<h3>Use Cases</h3>
---

```
UC1: Customer makes an order.
SC: Order is created.
```
```
UC2: Fulfiller can view orders.
SC: Orders are all shown for the fulfiller.
```
```
UC3: Fulfiller can view a specific order.
SC: Specific order is shown given a specific ID.
```
```
UC4: Customer can edit an order.
SC: Order is edited and submitted back.
```
```
UC5: Customer can cancel an order.
SC: Order is cancelled from the fulfillment process.
```
```
UC6: Customer can check an order's status.
SC: An order's status is shown to the customer. Describing current status (eg. is Processing).

UC6a: Fulfiller can check an order's status
SC: An order's status is shown to the fulfiller for race conditions.
```
```
UC7: Fulfiller can fulfill an order.
SC: The order was approved by the fulfiller and ready to be shipped.
```
```
UC8: Fulfiller can delete an order.
SC: The order is deleted from the stock.
```
<h3>API Documents</h3>
---
Documents here:<br>
* [API Document](http://goo.gl/ZmGMBL)
* [System Sequence Diagram] (https://docs.google.com/drawings/d/1oa0xyF83Y1m0LpsDUxY2LBXPuIIW5E6m14PXTilBrAk/edit)

<h3>Group Members</h3>
---
Pawin Suthipornopas 5510546123 <br>
Thunyathon Jaruchotrattanasakul 5510546972 <br>
Latthapat Tangtrustham 5510547014
