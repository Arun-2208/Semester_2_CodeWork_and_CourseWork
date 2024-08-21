import java.util.Scanner;
/**
 * This Application class serves as the user interface and has the main method
 * @author - Arun Ragavendhar - 104837257
 * @version
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
            
            switch(choice)
            {
                case 1:
                    {
                        System.out.println("please enter the slot ID");
                        slotID = scan.nextLine();
                        ParkingSlot slot =new ParkingSlot();
                        carPark.addSlot(slot);
                        break;
                    }
                case 2:
                        break;
                case 3:
                        break;
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
