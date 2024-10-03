/**
 * This class is to test the methods defined in Circle.
 * @author : Arun Ragavendhar - 104837257
 * @date : lab9 - 1/10/2024
 */
import java.util.Scanner;
/*
 * class to test the circle class and its functions bu taking user input  
 */
class TestCircle{

    public static void main(String args[]){
// scanner object
        Scanner sc = new Scanner(System.in);
        System.out.println("Hi , please enter the radius of the circle");
// variable for radius 
        double radius = sc.nextDouble();
        sc.nextLine();
// Circle object 
        Circle c1 = new Circle(radius);
// Perimeter and radius displayed to the user         
        System.out.println(" Perimeter : "+c1.getPerimeter());
        System.out.println(" Area : "+c1.getArea());
        
    }
}