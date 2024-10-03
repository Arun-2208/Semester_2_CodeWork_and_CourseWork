/**
 * This class is to test the methods defined in ResizableCircle.
 * @author : Arun Ragavendhar - 104837257
 * @date : lab9 - 1/10/2024
 */

import java.util.Scanner;

class TestResizableCircle {

    public static void main(String[] args) {
// sacnner object
        Scanner sc = new Scanner(System.in);
        System.out.println("Hi , please enter the radius of the circle");
// variable for radius 
        double radius = sc.nextDouble();
        sc.nextLine();
// object for ResizableCircle class 

        ResizableCircle c1 = new ResizableCircle(radius);
        System.out.println(" Perimeter : "+c1.getPerimeter());
        System.out.println(" Area : "+c1.getArea());

        System.out.println("Hi , please enter the percentage by which u want to change radius of the circle");
// Taking input from the user for resizing the radius 
        int percent = sc.nextInt();
        sc.nextLine();
// resizing the radius 
        c1.resize(percent);
// displaying the resized radius to the user 
        System.out.println(" Resized Radius : "+c1.radius);
        System.out.println(" Resized Perimeter : "+c1.getPerimeter());
        System.out.println(" Resized Area : "+c1.getArea());
    }
}