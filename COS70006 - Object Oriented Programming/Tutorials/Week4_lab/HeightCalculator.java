
import java.util.Scanner;

/**
 * This program calculates the estimated height of a child when they become an adult  
 * based on the current age oof the mother and the father
 * @author : Arun Ragavendhar Arunachalam Palaniyappan - 104837257
 * @version : 1.0 - lab 4 -
 */


class Height{

    private float fatherHeight;
    private float motherHeight;
    private int estimatedAdultHeight;
   
//constructor to calculate the child height using mthe height of the mother and father 

    public Height(float fatherHeight, float motherHeight, float choice){

        this.fatherHeight = fatherHeight;
        this.motherHeight = motherHeight;

        // if choice is male 
        if (choice == 0){        
            estimatedAdultHeight = (int) (Math.floor((( ((this.motherHeight*13.0)/12.0) + this.fatherHeight ) / 2.0)));
            System.out.println("Estimated height of adult male in inches : "+estimatedAdultHeight);
        }

        // if choice is female 
        else if (choice ==1){
            estimatedAdultHeight = (int) (Math.floor(( (((this.fatherHeight*12.0)/13.0) + this.motherHeight) / 2.0)));
            System.out.println("Estimated height of adult female in inches : "+estimatedAdultHeight);
        }
    }
}   

public class HeightCalculator{   
    public static void main(String args[]){

// scanner object to get the input from the user
        Scanner scan = new Scanner (System.in);
        int ch;

    // do - while loop keeps running again as many times the user wants by pressing 'y' or 'Y'

        do{
            System.out.println("Please enter the height of the mother in inches");
            float motherHeight = scan.nextFloat();

            System.out.println("Please enter the height of the father in inches");
            float fatherHeight = scan.nextFloat();

            System.out.println("press  0 for male or 1 for female");
            int choice = scan.nextInt();

        // Object of class height is created and the inputs are passed to the parameterised constructor 

            Height height = new Height(motherHeight,fatherHeight,choice);
            
            System.out.println("To continue press 'Y' or 'y'");
            scan.nextLine();
        // user enters their choice of whether they want to continue or not 

            ch=scan.nextLine().charAt(0);
        }while(ch =='y' || ch == 'Y');

    }
} 