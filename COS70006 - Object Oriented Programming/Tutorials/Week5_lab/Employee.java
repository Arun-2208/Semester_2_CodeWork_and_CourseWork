/**
 * Employee.java
 *
 * This class represents an Employee with a name, employee ID, and salary.
 * It provides methods to get and set the employee's details.
 * 
 * @author Author: Arun Ragavendhar - 104837257
 * @version - 1.0 - lab 5 
 */

 class Employee {

    private String name;          // Employee's name
    private int employeeID;       // Employee's ID
    private double salary;        // Employee's salary

    /**
     * Constructor to initialize the Employee object.
     * 
     * @param name The name of the employee.
     * @param employeeID The unique ID of the employee.
     * @param salary The salary of the employee.
     */
    public Employee(String name, int employeeID, double salary) {
        this.name = name;
        this.employeeID = employeeID;
        this.salary = salary;
    }
    /**
     * Gets the name of the employee.
     * 
     * @return The name of the employee.
     */
    public String getName() {
        return name;
    }

    /**
     * Gets the employee ID.
     * 
     * @return The employee ID.
     */
    public int getEmployeeID() {
        return employeeID;
    }

    /**
     * Gets the salary of the employee.
     * 
     * @return The salary of the employee.
     */
    public double getSalary() {
        return salary;
    }

    /**
     * Sets the name of the employee.
     * 
     * @param name The new name of the employee.
     */
    void setName(String name) {
        this.name = name;
    }

    /**
     * Sets the employee ID.
     * 
     * @param employeeID The new employee ID.
     */
    void setEmployeeID(int employeeID) {
        this.employeeID = employeeID;
    }

    /**
     * Sets the salary of the employee.
     * 
     * @param salary The new salary of the employee.
     */
    void setSalary(double salary) {
        this.salary = salary;
    }

    /**
     * Returns a string representation of the employee.
     * 
     * @return A string containing the employee's name, ID, and salary.
     */
    public String toString() {
        String info = "Name: " + this.name + "  Employee ID: " + this.employeeID + "  Salary: " + this.salary;
        return info;
    }
}
