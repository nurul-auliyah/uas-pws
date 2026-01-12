# 📚 API Documentation

## Base URL
```
http://your-api-domain/api
```

## Authentication
Semua endpoint (kecuali register & login) memerlukan header:
```
Authorization: Bearer {token}
```

---

## 🔐 AUTH ENDPOINTS

### 1. Register User
**POST** `/register`
```json
{
    "name": "John Doe",
    "email": "john@example.com",
    "password": "password123",
    "password_confirmation": "password123"
}
```
**Response (201):**
```json
{
    "success": true,
    "message": "Register berhasil",
    "data": {
        "id": 1,
        "name": "John Doe",
        "email": "john@example.com"
    }
}
```

### 2. Login
**POST** `/login`
```json
{
    "email": "john@example.com",
    "password": "password123"
}
```
**Response (200):**
```json
{
    "success": true,
    "message": "Login berhasil",
    "data": {
        "token": "eyJ0eXAiOiJKV1QiLCJhbGc...",
        "type": "Bearer"
    }
}
```

### 3. Get Current User
**GET** `/me`
**Headers:** `Authorization: Bearer {token}`

**Response (200):**
```json
{
    "success": true,
    "data": {
        "id": 1,
        "name": "John Doe",
        "email": "john@example.com"
    }
}
```

### 4. Refresh Token
**POST** `/refresh`
**Headers:** `Authorization: Bearer {token}`

**Response (200):**
```json
{
    "success": true,
    "message": "Token berhasil diperbarui",
    "data": {
        "token": "new_token_here",
        "type": "Bearer",
        "expires_in": 3600
    }
}
```

### 5. Logout
**POST** `/logout`
**Headers:** `Authorization: Bearer {token}`

**Response (200):**
```json
{
    "success": true,
    "message": "Logout berhasil"
}
```

---

## 🏫 FAKULTAS ENDPOINTS

### 1. Get All Fakultas
**GET** `/fakultas`
**Response (200):**
```json
{
    "success": true,
    "data": [
        {
            "fakultas_id": 1,
            "fakultas_code": "FK",
            "fakultas_name": "Fakultas Teknik",
            "created_at": "2025-01-09T...",
            "updated_at": "2025-01-09T..."
        }
    ]
}
```

### 2. Create Fakultas
**POST** `/fakultas`
```json
{
    "fakultas_code": "FK",
    "fakultas_name": "Fakultas Teknik"
}
```
**Response (201):**
```json
{
    "success": true,
    "message": "Fakultas berhasil ditambahkan",
    "data": {
        "fakultas_id": 1,
        "fakultas_code": "FK",
        "fakultas_name": "Fakultas Teknik"
    }
}
```

### 3. Get Fakultas by ID
**GET** `/fakultas/{id}`
**Response (200):**
```json
{
    "success": true,
    "data": {
        "fakultas_id": 1,
        "fakultas_code": "FK",
        "fakultas_name": "Fakultas Teknik"
    }
}
```

### 4. Update Fakultas
**PUT/PATCH** `/fakultas/{id}`
```json
{
    "fakultas_code": "FK",
    "fakultas_name": "Fakultas Teknik dan Sains"
}
```
**Response (200):**
```json
{
    "success": true,
    "message": "Fakultas berhasil diperbarui",
    "data": { ... }
}
```

### 5. Delete Fakultas
**DELETE** `/fakultas/{id}`
**Response (200):**
```json
{
    "success": true,
    "message": "Fakultas berhasil dihapus"
}
```

---

## 🎓 PRODI ENDPOINTS

### 1. Get All Prodi
**GET** `/prodi`
**Response (200):**
```json
{
    "success": true,
    "data": [
        {
            "prodi_id": 1,
            "fakultas_id": 1,
            "prodi_code": "IF",
            "prodi_name": "Informatika",
            "fakultas": {
                "fakultas_id": 1,
                "fakultas_code": "FK",
                "fakultas_name": "Fakultas Teknik"
            }
        }
    ]
}
```

### 2. Create Prodi
**POST** `/prodi`
```json
{
    "fakultas_id": 1,
    "prodi_code": "IF",
    "prodi_name": "Informatika"
}
```
**Response (201):**
```json
{
    "success": true,
    "message": "Prodi berhasil ditambahkan",
    "data": { ... }
}
```

### 3. Get Prodi by ID
**GET** `/prodi/{id}`
**Response (200):**
```json
{
    "success": true,
    "data": { ... }
}
```

### 4. Update Prodi (PUT)
**PUT** `/prodi/{id}`
```json
{
    "fakultas_id": 1,
    "prodi_code": "IF",
    "prodi_name": "Teknologi Informasi"
}
```

### 5. Update Prodi (PATCH)
**PATCH** `/prodi/{id}`
```json
{
    "prodi_name": "Teknologi Informasi"
}
```

### 6. Delete Prodi
**DELETE** `/prodi/{id}`
**Response (200):**
```json
{
    "success": true,
    "message": "Prodi berhasil dihapus"
}
```

### 7. Get Prodi by Fakultas
**GET** `/fakultas/{fakultas_id}/prodi`
**Response (200):**
```json
{
    "success": true,
    "data": [ ... ]
}
```

---

## 👨‍🎓 STUDENT ENDPOINTS

### 1. Get All Students
**GET** `/students`
**Response (200):**
```json
{
    "success": true,
    "data": [
        {
            "id": 1,
            "nis": "2024001",
            "nama": "Budi Santoso",
            "prodi_id": 1,
            "alamat": "Jl. Merdeka No. 123",
            "no_telepon": "081234567890",
            "email": "budi@example.com",
            "prodi": {
                "prodi_id": 1,
                "prodi_name": "Informatika"
            }
        }
    ]
}
```

### 2. Create Student
**POST** `/students`
```json
{
    "nis": "2024001",
    "nama": "Budi Santoso",
    "prodi_id": 1,
    "alamat": "Jl. Merdeka No. 123",
    "no_telepon": "081234567890",
    "email": "budi@example.com"
}
```
**Response (201):**
```json
{
    "success": true,
    "message": "Student berhasil ditambahkan",
    "data": { ... }
}
```

### 3. Get Student by ID
**GET** `/students/{id}`
**Response (200):**
```json
{
    "success": true,
    "data": { ... }
}
```

### 4. Update Student
**PUT/PATCH** `/students/{id}`
```json
{
    "nis": "2024001",
    "nama": "Budi Santoso",
    "prodi_id": 1,
    "alamat": "Jl. Merdeka No. 456",
    "no_telepon": "081234567890",
    "email": "budi@example.com"
}
```
**Response (200):**
```json
{
    "success": true,
    "message": "Student berhasil diupdate",
    "data": { ... }
}
```

### 5. Delete Student
**DELETE** `/students/{id}`
**Response (200):**
```json
{
    "success": true,
    "message": "Student berhasil dihapus"
}
```

### 6. Get Students by Prodi
**GET** `/prodi/{prodi_id}/students`
**Response (200):**
```json
{
    "success": true,
    "data": [ ... ]
}
```

---

## ✅ CHECKLIST PERBAIKAN YANG DILAKUKAN

- ✅ Menambahkan method `me()` di AuthController
- ✅ Menambahkan relasi `hasMany` di Fakultas Model
- ✅ Menambahkan relasi `students` di Prodi Model
- ✅ Melengkapi Student Model dengan fillable & relasi
- ✅ Memperbaiki migrations untuk students table
- ✅ Membuat StudentController lengkap dengan CRUD
- ✅ Menambahkan route Student di api.php
- ✅ Memperbaiki method patch() di ProdiController

---

## 🚀 Cara Menjalankan

```bash
# 1. Install dependencies
composer install

# 2. Setup environment
cp .env.example .env
php artisan key:generate

# 3. Run migrations
php artisan migrate

# 4. Start server
php artisan serve
```

Sekarang API Anda sudah lengkap dan siap digunakan! 🎉
