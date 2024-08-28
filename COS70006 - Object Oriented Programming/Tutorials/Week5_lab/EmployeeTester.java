

import java.util.ArrayList;
import java.util.List;
import java.util.Scanner;
/**
 * EmployeeTester.java
 *
 * This class is responsible for managing a list of Employee objects.
 * It provides methods to add employees to the list, display them, 
 * and find and update employee details based on their ID.
 * 
 * @author Author: Arun Ragavendhar - 104837257
 * @version - 1.0 - lab 5 
 */

 
 class EmployeeTester {
 
     private List<Employee> employees; // List to store employee objects
 
     /**
      * Constructor to initialize the EmployeeTester object.
      * Initializes an empty list of employees.
      */
     public EmployeeTester() {
         this.employees = new ArrayList<>();
     }
 
     /**
      * Adds an Employee object to the list.
      * @param employee The Employee object to be added to the list.
      */
     public void addToList(Employee employee) {
         this.employees.add(employee);
         System.out.println("Employee added to the array list.");
     }
 
     /**
      * Displays the details of all employees in the list.
      */
     public void displayEmployees() {
         for (Employee employee : employees) {
             System.out.println(employee.toString());
         }
     }
 
     /**
      * Finds an employee by ID and allows updating their details.
      * @param id The employee ID to search for.
      * @param scan The Scanner object for user input.
      */
     public void findAndUpdate(int id, Scanner scan) {
         int flag = 0;
         for (Employee employee : employees) {
             if (employee.getEmployeeID() == id) {
                 System.out.println("Employee has been found. Please make the updates.");
                 System.out.println(employee.toString());
 
                 System.out.println("Enter name:");
                 String name = scan.nextLine();
 
                 System.out.println("Enter salary:");
                 double salary = scan.nextDouble();
                 scan.nextLine();
 
                 employee.setName(name);
                 employee.setSalary(salary);
 
                 System.out.println("Updated record:");
                 System.out.println("Name: " + employee.getName());
                 System.out.println("Employee ID: " + employee.getEmployeeID());
                 System.out.println("Salary: " + employee.getSalary());
                 flag = 1;
             }
         }
         if (flag == 0) {
             System.out.println("The employee ID does not exist.");
         }
     }
 
     /**
      * Starts the user interface for interacting with the employee list.
      * Provides options to create, edit, and display employees.
      */
     public void start() {
         Scanner scan = new Scanner(System.in);
         char ch;
 
         do {
             System.out.println("1. Create and add an employee\n2. Edit employee details\n3. Display details of all employees\n");
             int choice = scan.nextInt();
             scan.nextLine();
 
             switch (choice) {
                 case 1: {
                     System.out.println("Enter name:");
                     String name = scan.nextLine();
 
                     System.out.println("Enter employee ID:");
                     int employeeID = scan.nextInt();
                     scan.nextLine();
 
                     System.out.println("Enter salary:");
                     double salary = scan.nextDouble();
                     scan.nextLine();
 
                     Employee employee = new Employee(name, employeeID, salary);
                     this.addToList(employee);
                     break;
                 }
                 case 2: {
                     System.out.println("Enter the employee ID you would like to update:");
                     int id = scan.nextInt();
                     scan.nextLine();
                     findAndUpdate(id, scan);
                     break;
                 }
                 case 3: {
                     displayEmployees();
                     break;
                 }
                 default:
                     System.out.println("Invalid choice. Please try again.");
             }
 
             System.out.println("To continue, press 'y' or 'Y'.");
             ch = scan.nextLine().charAt(0);
         } while (ch == 'Y' || ch == 'y');
     }
 
     /**
      * Main method to start the EmployeeTester application.
      */
     public static void main(String[] args) {
         EmployeeTester employeeTester = new EmployeeTester();
         employeeTester.start();
     }
 }
 