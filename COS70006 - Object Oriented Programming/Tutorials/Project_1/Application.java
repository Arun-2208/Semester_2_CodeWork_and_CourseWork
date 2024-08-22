import java.util.Scanner;

/**
 * The Application class is the entry point of the Parking Spot System.
 * It handles the console-based user interface and manages user interactions.
 */
public class Application {

    private CarPark carPark;

    public static void main(String[] args) {
        Application app = new Application();
        app.run();
    }

    /**
     * The run method starts the application and handles the main program loop.
     */
    public void run() {
        Scanner scanner = new Scanner(System.in);
        System.out.println("Welcome to the Parking Spot System!");

        // Prompt user to set up the car park with staff and visitor slots
        System.out.print("Enter number of staff slots: ");
        int staffSlots = scanner.nextInt();
        System.out.print("Enter number of visitor slots: ");
        int visitorSlots = scanner.nextInt();

        carPark = new CarPark(staffSlots, visitorSlots);
        int choice;

        // Main menu loop
        do {
            displayMenu();
            choice = scanner.nextInt();
            scanner.nextLine(); // Consume newline

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
                    System.out.println("Program end!");
                    break;
                default:
                    System.out.println("Invalid option. Please try again.");
            }

        } while (choice != 8);

        scanner.close();
    }

    /**
     * Displays the main menu options to the user.
     */
    private void displayMenu() {
        System.out.println("\nMenu:");
        System.out.println("1. Add a parking slot");
        System.out.println("2. Delete a parking slot");
        System.out.println("3. List all slots");
        System.out.println("4. Delete all unoccupied parking slots");
        System.out.println("5. Park a car");
        System.out.println("6. Find a car by registration number");
        System.out.println("7. Remove a car by registration number");
        System.out.println("8. Exit");
        System.out.print("Choose an option: ");
    }

    /**
     * Adds a new parking slot to the car park.
     * @param scanner The Scanner object to read user input.
     */
    private void addParkingSlot(Scanner scanner) {
        System.out.print("Enter slot ID (e.g., D01): ");
        String slotID = scanner.nextLine().toUpperCase();
        System.out.print("Is this a staff slot? (yes/no): ");
        boolean isStaff = scanner.nextLine().equalsIgnoreCase("yes");
        carPark.addSlot(new ParkingSlot(slotID, isStaff));
    }

    /**
     * Deletes a parking slot from the car park if it is not occupied.
     * @param scanner The Scanner object to read user input.
     */
    private void deleteParkingSlot(Scanner scanner) {
        System.out.print("Enter slot ID to delete: ");
        String slotID = scanner.nextLine().toUpperCase();
        carPark.deleteSlot(slotID);
    }

    /**
     * Parks a car into a specified slot in the car park.
     * @param scanner The Scanner object to read user input.
     */
    private void parkCar(Scanner scanner) {
        System.out.print("Enter slot ID: ");
        String slotID = scanner.nextLine().toUpperCase();
        System.out.print("Enter car registration number (e.g., T2345): ");
        String regNo = scanner.nextLine().toUpperCase();
        System.out.print("Enter owner's name: ");
        String owner = scanner.nextLine();
        System.out.print("Is the owner a staff member? (yes/no): ");
        boolean isStaff = scanner.nextLine().equalsIgnoreCase("yes");

        Car car = new Car(regNo, owner, isStaff);
        carPark.parkCar(slotID, car);
    }

    /**
     * Finds a car by its registration number and displays the slot and owner details.
     * @param scanner The Scanner object to read user input.
     */
    private void findCar(Scanner scanner) {
        System.out.print("Enter car registration number: ");
        String regNo = scanner.nextLine().toUpperCase();
        carPark.findCar(regNo);
    }

    /**
     * Removes a car from the car park by its registration number.
     * @param scanner The Scanner object to read user input.
     */
    private void removeCar(Scanner scanner) {
        System.out.print("Enter car registration number: ");
        String regNo = scanner.nextLine().toUpperCase();
        carPark.removeCar(regNo);
    }
}
