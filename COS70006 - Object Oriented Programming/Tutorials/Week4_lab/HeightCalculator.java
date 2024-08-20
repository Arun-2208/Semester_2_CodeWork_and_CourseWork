import java.util.Scanner;

class Height{

    private float fatherHeight;
    private float motherHeight;
    private int estimatedAdultHeight;
   

    public Height(float fatherHeight, float motherHeight, float choice){

        this.fatherHeight = fatherHeight;
        this.motherHeight = motherHeight;

        // if choice is male 
        if (choice == 1){        
            estimatedAdultHeight = (int) (Math.floor((( ((this.motherHeight*13.0)/12.0) + this.fatherHeight ) / 2.0)));
            System.out.println("Estimated height of adult male : "+estimatedAdultHeight);
        }

        // if choice is female 
        else if (choice ==2){
            estimatedAdultHeight = (int) (Math.floor(( (((this.fatherHeight*12.0)/13.0) + this.motherHeight) / 2.0)));
            System.out.println("Estimated height of adult female : "+estimatedAdultHeight);
        }
    }
}   

public class HeightCalculator{   
    public static void main(String args[]){

        Scanner scan = new Scanner (System.in);
        int ch;
        
        do{
            System.out.println("Please enter the height of the mother ");
            float motherHeight = scan.nextFloat();

            System.out.println("Please enter the height of the father ");
            float fatherHeight = scan.nextFloat();

            System.out.println("press 1. for male 2. for female");
            int choice = scan.nextInt();

            Height height = new Height(motherHeight,fatherHeight,choice);
            
            System.out.println("To continue press 'Y' or 'y'");
            scan.nextLine();
            ch=scan.nextLine().charAt(0);
        }while(ch =='y' || ch == 'Y');

    }
} 