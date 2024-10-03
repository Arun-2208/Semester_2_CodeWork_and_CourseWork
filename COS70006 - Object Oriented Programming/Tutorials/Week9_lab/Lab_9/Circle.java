/**
 * This class has a protected variable radius, which implements the interface GeometricObject.
3.
 * @author : Arun Ragavendhar - 104837257
 * @date : lab9 - 1/10/2024
 */

class Circle{

    protected double radius = 1.0;
/*
 * Constructor to initialise the radius
 */
    Circle(double radius){
        this.radius = radius;
    }
/*
 * function definition for perimeter 
 */
    double getPerimeter(){
        return (2*3.14*this.radius); 
    }
/*
 * function definition for perimeter 
 */
    double getArea(){
        return (3.14*this.radius*this.radius);
    }
}