import unittest
import time
from selenium import webdriver
from selenium.webdriver.common.keys import Keys
from selenium.webdriver.common.by import By
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC
from selenium.common.exceptions import NoSuchElementException, TimeoutException, WebDriverException

class TestStudentManagementSystem(unittest.TestCase):
    @classmethod
    def setUpClass(cls):
        # Set up the WebDriver for Edge
        cls.driver = webdriver.Edge()
        cls.driver.implicitly_wait(10)

    @classmethod
    def tearDownClass(cls):
        cls.driver.quit()

    def setUp(self):
        # This is run before each test
        self.error = None

    def tearDown(self):
        # This is run after each test
        if self.error is None:
            print(f"{self.id()} - PASS")
        else:
            print(f"{self.id()} - FAIL: {self.error}")

    def test_login(self):
        try:
            self.driver.get('http://localhost/QLSV_WEBSITE/login.php')
            self.driver.find_element(By.ID, "username").send_keys("abc")
            time.sleep(0.5)
            self.driver.find_element(By.ID, "password").send_keys("123")
            time.sleep(0.5)
            self.driver.find_element(By.ID, "submit").click()
            time.sleep(1)

            # Wait for the URL to change or for a specific element to appear indicating a successful login
            WebDriverWait(self.driver, 10).until(
                EC.url_to_be('http://localhost/QLSV_WEBSITE/index.php')  # Adjust URL as needed
            )
            
            # Optionally, check for a specific element on the index page that only appears after login
            WebDriverWait(self.driver, 10).until(
                EC.presence_of_element_located((By.ID, "Logout"))  # Adjust ID as needed
            )
        except Exception as e:
            self.error = str(e)
            self.fail("Login test failed: Could not log into the system.")

    def test_add_student(self):
        try:
            self.driver.find_element(By.LINK_TEXT, 'Add New Student').click()
            time.sleep(0.5)
            self.driver.find_element(By.NAME, 'name').send_keys('abcd')
            time.sleep(0.5)
            self.driver.find_element(By.NAME, 'email').send_keys('aaa@gmail.com')
            time.sleep(0.5)
            self.driver.find_element(By.ID, 'submit').click()
            time.sleep(0.5)
            
            # Wait for the alert to appear and accept it
            WebDriverWait(self.driver, 10).until(EC.alert_is_present())
            alert = self.driver.switch_to.alert
            alert_text = alert.text
            alert.accept()
            
            # Check the alert text to ensure the success message is displayed
            self.assertEqual(alert_text, 'Thêm sinh viên thành công', "Success alert not found.")
            
            # Verify redirection to the index page
            WebDriverWait(self.driver, 10).until(EC.url_to_be('http://localhost/QLSV_WEBSITE/index.php')) 
        except Exception as e:
            self.error = str(e)
            self.fail("Add student test failed.")


    def test_search_student(self):
        try:
            search_input = self.driver.find_element(By.ID, 'search_query')
            time.sleep(0.5)
            search_input.clear()
            search_input.send_keys('buitruong132100@gmail.com')
            time.sleep(0.5)
            search_input.submit()
            time.sleep(0.5)
            WebDriverWait(self.driver, 10).until(
                EC.presence_of_element_located((By.XPATH, "//td[contains(text(), 'buitruong132100@gmail.com')]"))
            )
        except Exception as e:
            self.error = str(e)
if __name__ == "__main__":
    unittest.main(failfast=True)
