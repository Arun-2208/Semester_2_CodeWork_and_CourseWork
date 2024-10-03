
/**
 * This class class ResizableCircle is defined as a subclass of the class Circle, which also implements an interface called Resizable, as shown in class diagram. The
interface Resizable declares an abstract method resize(), which modifies the dimension (such as radius) by the given percentage.
 * @author : Arun Ragavendhar - 104837257
 * @date : lab9 - 1/10/2024
 */

// A class that derives from Circle and implements the interface Resizable 
 class ResizableCircle extends Circle implements Resizable {

// Constructor for ResizableCircle class      
    ResizableCircle(double radius) {
        super(radius);
    }
// function definition being implemented to resize the radius 
    public void resize(int percent){
        super.radius = (super.radius * percent)/100;
    }
}