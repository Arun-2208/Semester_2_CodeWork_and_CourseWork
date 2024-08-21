import java.util.Scanner;
/**
 * This Application class serves as the user interface and has the main method
 * @author - Arun Ragavendhar - 104837257
 * @version -1.0
 */
public class Application
{
    // attribute - Car Park object 
    private CarPark carPark;

    /* Constructor creating and initializing class Application*/
    public Application()
    {
        carPark = new CarPark(); 
    }

    /* method to with a switch case to offer a menu of options to the user*/
    public void start()
    {
        Scanner scan = new Scanner(System.in);
        
        while(true)
        {
            System.out.println("1.Add a parking slot");
            System.out.println("2.Delete a parking slot");
            System.out.println("3.List all slots");
            System.out.println("4.Park a car");
            System.out.println("5.Find a car by registration number");
            System.out.println("6.Remove a car");
            System.out.println("7.Exit");
        
            int choice = scan.nextInt();
            scan.nextLine();
            
            String slotID;
            boolean isVisitorSlot;
            boolean result;
            
            switch(choice)
            {
                case 1:
                    {   // creating and adding slot to the car park 
                        
                        System.out.println("please enter the slot ID");
                        slotID = scan.nextLine();
                        System.out.println("please enter 1.for Vistor type 0.for staff type"); 
                        isVisitorSlot = scan.nextInt()!=0;
                        
                        ParkingSlot slot =new ParkingSlot(slotID,isVisitorSlot);
                        result = carPark.addSlot(slot);
                        if(result == true)
                            System.out.println("Slot created and added \n");
                        if(result == false)
                            System.out.println("Slot already exists ");
                            
                        break;
                    }
                case 2:
                        break;
                case 3:
                    {
                        
                        carPark.listSlots();
                        break;
                    }
                case 4:
                        break;
                case 5:
                        break;
                case 6:
                        break;
                case 7:
                    System.out.println("Program end!");
                        return;
                default:
                    System.out.println("Invalid choice.Please try again.");
                        
            }
        
        }
    }
    
    public static void main(String[] args)
    {
        Application app = new Application();
        app.start();
    }
}
