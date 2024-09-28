from xml.dom.minidom import Element
from selenium import webdriver
from selenium.webdriver.common.action_chains import ActionChains
from selenium.webdriver.common.keys import Keys
from selenium.webdriver.common.by import By
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC
from selenium.common.exceptions import NoSuchElementException
from selenium.common.exceptions import TimeoutException
import time
import json
import os
# Access to twitter

url = r'https://twitter.com/i/flow/login'
# url = r'https://twitter.com/BillGates'
driver = webdriver.Chrome()
driver.get(url)



def waitfunc(by_variable, attribute):
    try:
        WebDriverWait(driver, 20).until(lambda x: x.find_element(by=by_variable,  value=attribute))
    except (NoSuchElementException, TimeoutException):
        print('{} {} not found'.format(by_variable, attribute))
        exit()

def searchtwitterprofile(name, twprofile):

    waitfunc(By.NAME,"text")
    username = driver.find_element(By.NAME, "text")
    username.send_keys('agustinnb')
    username.send_keys(Keys.RETURN)

    #chk = driver.find_element(By.XPATH, "//*[text()[contains(., 'Siguiente')]]")

    # ActionChains(driver).move_to_element(chk).click().perform()
    waitfunc(By.NAME, "password")
    password = driver.find_element(By.NAME, "password")
    password.send_keys('S*u!35971526!g*A')
    password.send_keys(Keys.RETURN)

    waitfunc(By.XPATH,"//input[@data-testid='SearchBox_Search_Input']")
    searchbox = driver.find_element(By.XPATH,"//input[@data-testid='SearchBox_Search_Input']")
    searchbox.send_keys(name)
    searchbox.send_keys(Keys.RETURN)

    waitfunc(By.XPATH,"//*[text()[contains(., '@BillGates')]]")
    profile = driver.find_element(By.XPATH,"//*[text()[contains(., '"+twprofile+"')]]")
    profile.click()

    waitfunc(By.XPATH,"//div[@data-testid='tweetText'][1]")
    tweets = []
    elements = driver.find_elements(By.XPATH,"//div[@data-testid='tweetText']")
    for i in elements:
        tweets.append(i.get_attribute('innerHTML'))
    for i in range(0,10):
        driver.execute_script("window.scrollTo(0, "+str(500*(i+1))+");")
        time.sleep(3)
        tweetstemp = driver.find_elements(By.XPATH,"//div[@data-testid='tweetText']")
        for m in tweetstemp:
            yaesta=False
            for i in tweets:
                if m.get_attribute('innerHTML')==i:
                    yaesta=True
            if (yaesta==False):
                tweets.append(m.get_attribute('innerHTML'))

    driver.close()

    return(tweets)