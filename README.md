
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
   [Provide the command to install composer dependencies]
   ```

3. **Set up environment variables:**
    - Duplicate the `.env.example` file and rename the copy to `.env`.
    - Update the `.env` file with your configuration settings.

4. **Generate application key:**
   ```bash
   ./vendor/bin/sail artisan key:generate
   ```

5. **Run database migrations:**
   ```bash
   ./vendor/bin/sail artisan migrate
   ```

6. **Start the development server:**
   ```bash
   ./vendor/bin/sail up
   ```
   Access the application at `http://localhost`.

## Usage

[Provide instructions on how to use the application, including any necessary screenshots or examples.]

### Commands

### 

### CI/CD
./vendor/bin/sail  pint
./vendor/bin/sail  test
