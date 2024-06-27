import time
import requests
import json
import random
import string
from fake_useragent import UserAgent
import random
import requests
import json
import scrapy
from scrapy.crawler import CrawlerProcess
import urllib3

urllib3.disable_warnings(urllib3.exceptions.InsecureRequestWarning)



def get_random_user_agent(file_path):
    with open(file_path, 'r') as file:
        user_agents = file.readlines()
    
    # Remove any leading/trailing whitespace characters, including newlines
    user_agents = [ua.strip() for ua in user_agents if ua.strip()]

    return random.choice(user_agents)
def generate_random_email(domain="hotmail.com"):
    username_length = random.randint(20, 28)
    username = ''.join(random.choices(string.ascii_letters + string.digits, k=username_length))
    email = f"{username}@{domain}"
    return email


def generate_random_password(length=12):
    if length < 6:
        raise ValueError("Password length must be at least 6 characters")
    
    all_characters = string.ascii_letters + string.digits + string.punctuation
    password = ''.join(random.choices(all_characters, k=length))
    return password

def create_account(emails, password):
  
    url = "https://gateway.chegg.com/auth-gate/"
    random_user_agent = get_random_user_agent('user_agents.txt')
    payload = "{\"query\":\"mutation Signup($userCredentials: UserCredentials!, $userProfile: UserProfile!, $clientId: String!) {\\n signUpUser(\\n userCredentials: $userCredentials\\n userProfile: $userProfile\\n clientId: $clientId\\n ) {\\n tokens {\\n idToken\\n accessToken\\n expires\\n }\\n encryptedEmail\\n encryptedCheggId\\n uuid\\n }\\n}\\n\",\"variables\":{\"userCredentials\":{\"email\":\"{{email_placeholder}}\",\"password\":\"{{password_placeholder}}\"},\"userProfile\":{\"sourceProduct\":\"core|auth|CHGG\",\"sourcePage\":\"chegg|auth|Sign out\"},\"clientId\":\"CHGG\"}}"
    payload = payload.replace("{{email_placeholder}}", emails)
    payload = payload.replace("{{password_placeholder}}", password)
    proxies = {
        "http": "http://scraperapi:6b776709af6bbace1276eb85be2ccf44@proxy-server.scraperapi.com:8001",
        "https": "http://scraperapi:6b776709af6bbace1276eb85be2ccf44@proxy-server.scraperapi.com:8001"
        }
    headers = {
    'accept': 'application/json',
    'accept-language': 'en-US,en;q=0.9',
    'content-type': 'application/json',
    #'cookie': 'country_code=IN; langPreference=en-US; hwh_order_ref=/homework-help/questions-and-answers/p10-198-increasing-demand-xylene-petrochemical-industry-production-xylene-toluene-dispropo-q63956832; CVID=13d441d4-6430-450c-b8c7-3a4a1f32055d; CSID=1719422391519; V=7f0181d572b5a4d40fc4df0081e542b5667c4dbaef9db4.42533713; opt-user-profile=13d441d4-6430-450c-b8c7-3a4a1f32055d%252C29438490978%253A29520940603%252C28952560068%253A29072940149; usprivacy=1---; OneTrustWPCCPAGoogleOptOut=true; pxcts=4ed04545-33e0-11ef-81a0-a5c3d1ddb048; _pxvid=4ed03879-33e0-11ef-81a0-c7eb5e4c559b; OptanonConsent=isGpcEnabled=0&datestamp=Wed+Jun+26+2024+22%3A49%3A56+GMT%2B0530+(India+Standard+Time)&version=202402.1.0&browserGpcFlag=0&isIABGlobal=false&hosts=&consentId=1ebc63ed-2082-40b8-abde-0f0d6b20c8fe&interactionCount=0&isAnonUser=1&landingPath=https%3A%2F%2Fwww.chegg.com%2Fhomework-help%2Fquestions-and-answers%2Fp10-198-increasing-demand-xylene-petrochemical-industry-production-xylene-toluene-dispropo-q63956832&groups=fnc%3A0%2Csnc%3A1%2Ctrg%3A0%2Cprf%3A0; _px3=6c3f8887cb705df01ca6b78a5c163598257fcd63ab9b36006cd890fa4f97cdb2:bs9ru1nnbMeGClvJjwnbiQ9YOc5fc6Xd4C5+u3yy3JrZwOarFAAPf9hrZAlwUTUnpScE0TcgMZgkv3FB5TvxYA==:1000:FMMvWFFrsxR1Lls4pbghtplHVQsnIyZKDLIWyqlZ/3Uxe1iyAzbp6Duo9CSWhNdYqZizGFK7ak9ryqyHeVnwYbD7hivzyax6W0s+t1aiD0/qhInFouL531K8W34L2pPc/WA9H+tzha481u46Q/5zasiGEVQP2xgJNA4Np/yvPAxIMxgTjX9bA2OatkjApityDM05Xt42tqXINDi9tmpdubvx7wed21/a+K/zviuWjb4=; _px=bs9ru1nnbMeGClvJjwnbiQ9YOc5fc6Xd4C5+u3yy3JrZwOarFAAPf9hrZAlwUTUnpScE0TcgMZgkv3FB5TvxYA==:1000:M8rtTaGWEZWzSCH0H0xFoX95wsC4GEP7zOD+Q/hVLyJ2JA/jFRhu1mH8EG+cR3MDn7ytLJWShBl4iPZ//fJmE9RdthdGiCKwfD3vnEFjAxBQjDF548oQR3jA0rmgCLjJLqgt9kEjpZZ4rEdS+scEjk1M7Fxpy7FKZm+qEDQHAYose/WE6cblpzW2giAZeE4OwTyDJEpKlHq3Q9TPX+kdmYsa3L2lFvZaBG+pUdMOgNduCYQsJM+lgzjd2fDw6L5VpFzlK3AXCf1XpdhliafrUA==; schoolapi=null; _pxde=3b640087c1b5f6f94ec6507b405dc6bd4542cbf609db2bd1ac95e54550355aab:eyJ0aW1lc3RhbXAiOjE3MTk0MjI0MDA5OTR9',
    'dnt': '1',
    'origin': 'https://www.chegg.com',
    'priority': 'u=1, i',
    'referer': 'https://www.chegg.com/',
    'sec-ch-ua': '"Not/A)Brand";v="8", "Chromium";v="126", "Google Chrome";v="126"',
    'sec-ch-ua-mobile': '?0',
    'sec-ch-ua-platform': '"Linux"',
    'sec-fetch-dest': 'empty',
    'sec-fetch-mode': 'cors',
    'sec-fetch-site': 'same-site',
    'user-agent': str(random_user_agent)
    }

    response = requests.request("POST", url, headers=headers, data=payload ,proxies=proxies , verify=False)
    return response.json()

def main():
    num_accounts = 2
    accounts = []
    for i in range(num_accounts):
        email = generate_random_email()
        password = generate_random_password(16)
        response = create_account(email, password)
        account_info = {
            "email": email,
            "password": password,
            "response": response
        }
        accounts.append(account_info)
        print(f"Created account {i+1}: {email} - {response}")
        time.sleep(1)  # To avoid getting rate limited

    with open("accounts.json", "a") as outfile:
        json.dump(accounts, outfile, indent=4)

if __name__ == "__main__":
    main()        