
# Super Spin
SuperSpin, a startup based in Cairo, Egypt, with the vision of becoming the "Ultimate Marketplace for Table Tennis Players", it connects Table Tennis Players with professional Coaches for one-on-one training sessions.

## Pre-requisites
- Download and install [Docker Desktop](https://www.docker.com)

## Installation

To set up the project locally:

1. **Clone the repository:**
   ```bash
   git clone https://github.com/lossantis/super-spin.git
   cd super-spin
   ```

2. **Install dependencies:**
   ```bash
   ./vendor/bin/sail up --build
   ```

3. **Set up environment variables:**
    - Duplicate the `.env.example` file and rename the copy to `.env`.

4. **Generate application key:**
   ```bash
   ./vendor/bin/sail artisan key:generate
   ```

5. **Run database migrations:**
   ```bash
   ./vendor/bin/sail artisan migrate
   ```

6. **Run database seeders:**
   ```bash
   ./vendor/bin/sail artisan db:seed
   ```

7. **Start the development server:**
   ```bash
   ./vendor/bin/sail up
   ```

8. **Stop the development server:**
   ```bash
   ./vendor/bin/sail down
   ```

## API usage\
### 1. Get coaches (Controller index method)
```http request
GET /api/coach
```

### 2. Get single coach (Controller show method)
```http request
GET /api/coach/{coachId}
 ```
##### Examples
###### Request
```http request
GET /api/coach/d3f57bb2-0c25-478a-a61c-26cd282050c4
 ```

### 3. Add coach (Controller store method)

#### Endpoint:
```http request
POST /api/coach
```
##### Examples
###### Payload:
```json
{
    "name": "Hugo Santos", 
    "years_of_experience": 10, 
    "hourly_rate": 11.5, 
    "city": "Braga",
    "country": "Portugal", 
    "start_date": "2023-01-23T08:00:00.000000Z"
}
```

### 4. Add coach (Controller update method)
#### Endpoint:
```http request
PUT /api/coach/{coachId}
```

##### Examples
###### Request:
```http request
PUT /api/coach/d3f57bb2-0c25-478a-a61c-26cd282050c4
```

##### Payload:
```json
{
    "name": "Hugo Santos",
    "years_of_experience": 20,
    "hourly_rate": 50,
    "city": "Lisboa",
    "country": "Portugal",
    "start_date": "2023-01-01T08:00"
}
```

### 5. Add coach (Controller update method)
#### Endpoint:
```http request
DELETE /api/coach/{coachId}
```
##### Examples
###### Request
```http request
DELETE /api/coach/d3f57bb2-0c25-478a-a61c-26cd282050c4
```

## Web usage
* Access the application at `http://localhost`. The coaches list will be loaded.
* To filter the coach by name, country or city, type the text on search textbox and press send button.
* To sort the coach by hourly rate ascending or descending, choose on the dropdown and press send button.
