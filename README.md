# Nadsoft
Nadsoft Project

This project is a **checkout Form system** developed as part of a machine test. It simulates a simple e-commerce flow with an initial order, optional upsells, and a final thank-you summary page.

---

## ⚙️ Technologies Used

- **Frontend:** HTML, CSS, Bootstrap 5, JavaScript (ES6)
- **Backend (optional):** PHP (with PDO), MySQL
- **Storage:** `sessionStorage` (in HTML-only version) or PHP `$_SESSION`
- **Design:** Fully responsive using Bootstrap 5

---

## Form Flow

1. **`index.html`**  
   User fills in a checkout form (name, email, billing info). On submit, data is validated and stored in `sessionStorage`, then user is redirected to Upsell 1.

2. **`upsell1.html`**  
   User is offered an additional product (e.g., VIP Access).  
   - If **"Add to my Order"**, the upsell is stored.  
   - If **"No Thank You"**, proceeds to Upsell 2.

3. **`upsell2.html`**  
   Similar structure to upsell1. Offers a second product.

4. **`thank-you.php`**  
   Displays all selected products (initial + upsells if chosen) in a clean summary table.

---

## 📁 File Structure
/Nadsoft/
├── index.html
├── upsell1.html
├── upsell1.php 
├── upsell2.html
├── upsell2.php
├── save-order.php
├── config.php
├── thank-you.html
├── /assets/
│ ├── /css/style.css
|       └── upsell.css
│ └── /js/script.js
| └── /img/b13.jpg
|       |── favicon.png
|       └── upsell.jpg
├── /sql/
  └── schema.sql



---

## Database Setup 

If you're building the PHP version, create a database called:

```sql
CREATE DATABASE nadsoft;
USE nadsoft;
CREATE TABLE members (
    id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(100),
    last_name VARCHAR(100),
    username VARCHAR(100),
    email VARCHAR(100),
    address TEXT,
    address2 TEXT,
    country VARCHAR(50),
    state VARCHAR(50),
    zip VARCHAR(20),
    payment_method VARCHAR(50),
    card_name VARCHAR(100),
    card_number VARCHAR(30),
    card_expiration VARCHAR(10),
    card_cvv VARCHAR(10),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
CREATE TABLE member_orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    member_id INT,
    product VARCHAR(100),
    price INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (member_id) REFERENCES members(id) ON DELETE CASCADE
);


