# Laravel E-Commerce website

### 1. Clone & Environment

```bash
git clone https://github.com/AlexBoiko412/laravel_e_commerce
cd ua-store
cp .env.example .env

```

### 2. Install Dependencies

### 3. Spin Up the Containers

```bash
./vendor/bin/sail up -d

```

### 4. Application Setup

```bash
./vendor/bin/sail artisan key:generate
./vendor/bin/sail artisan migrate --seed
./vendor/bin/sail artisan lang:publish
./vendor/bin/sail artisan lang:add uk # Setup Ukrainian validation

```

### 5. Frontend Assets

```bash
./vendor/bin/sail npm install
./vendor/bin/sail npm run dev

```
## Default Credentials
| Role | Email | Password |
| --- | --- | --- |
| **Admin** | `admin@example.com` | `password` |
| **Customer** | `user@example.com` | `password` |
---
**MySQL** database is seeded with a lot of data already. Engineered with a focus on data integrity, financial immutability.
Database - https://dbdiagram.io/d/69a42301a3f0aa31e16e6d4e
<img width="2007" height="1845" alt="Database" src="https://github.com/user-attachments/assets/3173ac8e-059b-4ea7-8c1b-fc4950b3216f" />
