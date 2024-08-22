import java.util.ArrayList;
import java.util.List;
import java.util.Scanner;

class EmployeeTester{

    List<Employee> employees;

    public EmployeeTester(){
        this.employees = new ArrayList<>();
    }

    public void addToList(Employee employee){
        this.employees.add(employee);
        System.out.println("employee added to the <array list>");
    }

    public void start(){


        Scanner scan = new Scanner (System.in);

        char ch;

    
        do{
            System.out.println("1. create and add an employee\n2. edit employee details\n 3.display details fo all employees\n");

            int choice = scan.nextInt();
            scan.nextLine();

            System.out.println("name");
            String name = scan.nextLine();
            
            System.out.println("employeeID");
            int employeeID = scan.nextInt();
            scan.nextLine();

            System.out.println("salary");
            double salary = scan.nextDouble();
            scan.nextLine();

            switch(choice){

                case 1:{
                        Employee employee = new Employee(name, employeeID, salary);
                        this.addToList(employee);
                        break;
                        }
                case 2:{

                        break;
                        }
                case 3:{
                        
                        break;
                        }

            }
            System.out.println("to continue press y or Y");
            ch = scan.nextLine().charAt(0);
            scan.nextLine();
        }while (ch == 'Y' || ch == 'y');
    }

    public static void main(String[] args) {
        
        EmployeeTester employeeTester = new EmployeeTester();
        employeeTester.start();
    }
}