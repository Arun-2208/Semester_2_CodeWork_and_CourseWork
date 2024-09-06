import java.util.Scanner;
import java.util.regex.Pattern;

/**
 * The Application class is the entry point of the Parking Spot System.
 * It handles the console-based user interface and manages user interactions.
 * @author - Arun Ragavendhar - 104837257
 * @version - 1.0 - 06/09/2024
 */
public class Application {

    private CarPark carPark;
    private static final Pattern SLOT_ID_PATTERN = Pattern.compile("^[SV]\\d{2}$");
    private static final Pattern REG_NO_PATTERN = Pattern.compile("^[A-Z]\\d{4}$");
    private static final Pattern OWNER_NAME_PATTERN = Pattern.compile("^[A-Za-z ]+$");

    public static void main(String[] args) {
        Application app = new Application();
        app.run();
    }

    /**
     * The run method starts the application and handles the main program loop.
     */
    public void run() {
        Scanner scanner = new Scanner(System.in);
        System.out.println("\nWelcome to the Parking Spot System!");

        // Asking the user to set up the car park with staff and visitor slots
        int staffSlots = getValidatedSlotCount(scanner, "\nEnter number of staff slots: ");
        int visitorSlots = getValidatedSlotCount(scanner, "\nEnter number of visitor slots: ");

        carPark = new CarPark(staffSlots, visitorSlots);
        int choice;

        // Main menu loop
        do {
            displayMenu();
            choice = getValidatedMenuChoice(scanner);

            // Handle menu options
            switch (choice) {
                case 1:
                    addParkingSlot(scanner);
                    break;
                case 2:
                    deleteParkingSlot(scanner);
                    break;
                case 3:
                    carPark.listAllSlots();
                    break;
                case 4:
                    carPark.deleteAllUnoccupiedSlots();
                    break;
                case 5:
                    parkCar(scanner);
                    break;
                case 6:
                    findCar(scanner);
                    break;
                case 7:
                    removeCar(scanner);
                    break;
                case 8:
                    System.out.println("\nProgram end!\n");
                    break;
                default:
                    System.out.println("\nInvalid option. Please try again.");
            }

        } while (choice != 8);

        scanner.close();
    }

    /**
     * Displays the main menu options to the user.
     */
    private void displayMenu() {
        System.out.println("\n-----------------------------------------------");
        System.out.println("\nMenu:");
        System.out.println("1. Add a parking slot");
        System.out.println("2. Delete a parking slot");
        System.out.println("3. List all slots");
        System.out.println("4. Delete all unoccupied parking slots");
        System.out.println("5. Park a car");
        System.out.println("6. Find a car by registration number");
        System.out.println("7. Remove a car by registration number");
        System.out.println("8. Exit\n");
        System.out.print("Choose an option: \n");
        System.out.println("-----------------------------------------------\n");
    }

    /**
     * Validates the number of staff or visitor slots.
     */
    private int getValidatedSlotCount(Scanner scanner, String userInput) {
        int count;
        while (true) {
            System.out.print(userInput);
            if (scanner.hasNextInt()) {
                count = scanner.nextInt();
                scanner.nextLine();
                if (count > 0 && count <=75) {
                    return count;
                }
                else if(count > 75) {
                    System.out.println("\nThe maximum capacity is 75 parking slots per slot type . Please enter a number within that capacity");
                }
                else {
                System.out.println("\nPlease enter a positive number.");
                }
            } else {
                System.out.println("\nInvalid input. Please enter a number.");
                scanner.next(); // consume the invalid input
            }
        }
    }

    /**
     * Validates the user's menu choice.
     */
    private int getValidatedMenuChoice(Scanner scanner) {
        int choice;
        while (true) {
            if (scanner.hasNextInt()) {
                choice = scanner.nextInt();
                scanner.nextLine();
                if (choice >= 1 && choice <= 8) {
                    return choice;
                }
                System.out.println("\nPlease choose a valid option between 1 and 8.");
            } else {
                System.out.println("\nInvalid input. Please enter a number.");
                scanner.next(); // consume the invalid input
            }
        }
    }

    /**
     * Adds a new parking slot to the car park after validating the slot ID.
     * @param scanner The Scanner object to read user input.
     */
    private void addParkingSlot(Scanner scanner) {
        System.out.print("\nEnter slot ID (e.g., S01 - staff, VO1 - visitor): ");
        String slotID = getValidatedSlotID(scanner);
        if (carPark.isSlotIDUnique(slotID)) {
            System.out.print("\nIs this a staff or visitor slot? (staff/visitor): ");
            boolean isStaff = scanner.nextLine().equalsIgnoreCase("staff");
            carPark.addSlot(new ParkingSlot(slotID, isStaff));
        } else {
            System.out.println("\nSlot ID must be unique. Entered slot ID already exists.");
        }
    }

    /**
     * Deletes a parking slot from the car park after checking that it is unoccupied.
     * @param scanner The Scanner object to read user input.
     */
    private void deleteParkingSlot(Scanner scanner) {
        System.out.print("\nEnter slot ID to delete: ");
        String slotID = getValidatedSlotID(scanner);
        if (carPark.isSlotOccupied(slotID)) {
            System.out.println("\nCannot delete an occupied slot.");
        } else {
            carPark.deleteSlot(slotID);
        }
    }

    /**
     * Parks a car into a specified slot after validating input and conditions.
     * @param scanner The Scanner object to read user input.
     */
    private void parkCar(Scanner scanner) {
        System.out.print("\nEnter slot ID: ");
        String slotID = getValidatedSlotID(scanner);
        System.out.print("\nEnter car registration number (e.g., T6345): ");
        String regNo = getValidatedRegNo(scanner);
        System.out.print("\nEnter owner's name: ");
        String owner = getValidatedOwnerName(scanner);
        System.out.print("\nIs the owner a staff or visitor? (staff/visitor): ");
        boolean isStaff = (scanner.nextLine().equalsIgnoreCase("staff"));

        if (carPark.isSlotAvailable(slotID, isStaff)) {
            Car car = new Car(regNo, owner, isStaff);
            carPark.parkCar(slotID, car);
        } else {
            System.out.println("\nCannot park the car in this slot. PLease make sure it's available and the car type matches the slot type.");
        }
    }

    /**
     * Finds a car by its registration number and displays the slot and owner details.
     * @param scanner The Scanner object to read user input.
     */
    private void findCar(Scanner scanner) {
        System.out.print("\nEnter car registration number: ");
        String regNo = getValidatedRegNo(scanner);
        carPark.findCar(regNo);
    }

    /**
     * Removes a car from the car park by its registration number.
     * @param scanner The Scanner object to read user input.
     */
    private void removeCar(Scanner scanner) {
        System.out.print("\nEnter car registration number: ");
        String regNo = getValidatedRegNo(scanner);
        carPark.removeCar(regNo);
    }

    /**
     * Validates the slot ID using a regex pattern.
     */
    private String getValidatedSlotID(Scanner scanner) {
        String slotID;
        while (true) {
            slotID = scanner.nextLine().toUpperCase();
            if (SLOT_ID_PATTERN.matcher(slotID).matches()) {
                return slotID;
            }
            else{
            System.out.print("\nInvalid slot ID. Please enter a valid slot ID (e.g., S01 ,V01): ");
            }
        }
    }

    /**
     * Validates the owner name using a regex pattern.
     */
    private String getValidatedOwnerName(Scanner scanner){
        String owner;

        while(true){
            owner = scanner.nextLine();
            if(OWNER_NAME_PATTERN.matcher(owner).matches()){
                return owner;
            }
            else{
            System.out.println("\nInvalid name . The name must have only alphabets ");
            }
        } 
    }

    /**
     * Validates the car registration number using a regex pattern.
     */
    private String getValidatedRegNo(Scanner scanner) {
        String regNo;
        while (true) {
            regNo = scanner.nextLine().toUpperCase();
            if (REG_NO_PATTERN.matcher(regNo).matches()) {
                return regNo;
            }
            else{
            System.out.print("\nInvalid registration number. Please enter a valid registration number (e.g., T2345): ");
            }
        }
    }
}
