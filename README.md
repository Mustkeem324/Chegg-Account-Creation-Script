# Chegg Account Creation Script

## Overview

This script automates the creation of accounts on Chegg.com by generating random user credentials and submitting them via an HTTP POST request. The generated account details and server responses are saved in a JSON file.

## Prerequisites

- Python 3.x
- Required Python packages:
  - requests
  - fake_useragent
  - scrapy (not directly used in the script, but included in the imports)
  - urllib3

You can install the required packages using pip:

```bash
pip install requests fake-useragent scrapy urllib3
```

## Usage

1. **User Agent File**: Create a text file named `user_agents.txt` in the same directory as the script. Populate this file with a list of user agent strings, each on a new line. This file will be used to randomly select a user agent for each account creation request.

2. **Configure Proxy**: The script uses a proxy service to avoid rate limiting. Ensure that the proxy URL and credentials are correctly set in the `proxies` dictionary within the `create_account` function.

3. **Run the Script**: Execute the script using the following command:

```bash
python create_accounts.py
```

## Script Details

- **Functions**:
  - `get_random_user_agent(file_path)`: Reads a list of user agents from a specified file and returns a random user agent.
  - `generate_random_email(domain)`: Generates a random email address with the specified domain.
  - `generate_random_password(length)`: Generates a random password with the specified length.
  - `create_account(emails, password)`: Sends a POST request to the Chegg signup endpoint with the generated credentials.

- **Main Function**: 
  - The `main` function generates a specified number of accounts, creates them on Chegg, and stores the account details in `accounts.json`.

## Example

This script is configured to create 2 accounts by default. You can adjust the `num_accounts` variable in the `main` function to create more accounts if needed.

## Notes

- **Proxy**: Ensure that the proxy credentials are valid and the proxy server is accessible.
- **User Agent**: The script requires a `user_agents.txt` file to randomly select a user agent for each request.
- **Rate Limiting**: A `time.sleep(1)` call is included between account creations to avoid rate limiting by the server.

## Disclaimer

This script is intended for educational purposes only. Use it responsibly and ensure compliance with the terms of service of the website you are interacting with.

## License

This project is licensed under the MIT License.
