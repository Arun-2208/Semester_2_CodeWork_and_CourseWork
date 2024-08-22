class Employee{

    String name;
    int employeeID;
    double salary;

    public Employee(String name, int employeeID, double salary){
        this.name = name;
        this.employeeID = employeeID;
        this.salary = salary;
    }
    public String getName(){
        return name;
    }
    public int getEmployeeID(){
        return employeeID;
    }
    public double salary(){
        return salary;
    }
    void setName(String name){
        this.name = name;
    }
    void setEmployeeID(int employeeID){
        this.employeeID = employeeID;
    }
    void setSalary(double salary){
        this.salary = salary;
    }

    public String toString(){
        String info = " Name : " + this.name + "Employee ID : " + this.employeeID + "salary : " + this.salary;
        return info;
    }
}