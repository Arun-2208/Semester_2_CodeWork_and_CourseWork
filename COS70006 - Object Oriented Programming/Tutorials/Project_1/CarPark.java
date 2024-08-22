import java.util.ArrayList;
import java.util.List;

/**
 * The CarPark class manages a collection of parking slots.
 * It allows for adding, deleting, listing, and finding slots and cars.
 */
public class CarPark {

    private List<ParkingSlot> slots;

    /**
     * Initializes the CarPark with a specified number of staff and visitor slots.
     * @param staffSlots Number of staff slots.
     * @param visitorSlots Number of visitor slots.
     */
    public CarPark(int staffSlots, int visitorSlots) {
        slots = new ArrayList<>();
        char staffIdentifier = 'S';
        char visitorIdentifier = 'V';
        // Generate staff slots
        for (int i = 1; i <= staffSlots; i++) {
            slots.add(new ParkingSlot(staffIdentifier + String.format("%02d", i), true));
        }
        // Generate visitor slots
        for (int i = 1; i <= visitorSlots; i++) {
            slots.add(new ParkingSlot(visitorIdentifier + String.format("%02d", i), false));
        }
    }

    /**
     * Adds a new parking slot to the car park.
     * @param slot The ParkingSlot object to add.
     */
    public void addSlot(ParkingSlot slot) {
        if (getSlot(slot.getSlotID()) == null) {
            slots.add(slot);
            System.out.println("Slot added successfully.");
        } else {
            System.out.println("Slot ID already exists.");
        }
    }

    /**
     * Deletes a parking slot if it is not occupied.
     * @param slotID The ID of the slot to delete.
     */
    public void deleteSlot(String slotID) {
        ParkingSlot slot = getSlot(slotID);
        if (slot != null) {
            if (!slot.isOccupied()) {
                slots.remove(slot);
                System.out.println("Slot deleted successfully.");
            } else {
                System.out.println("Slot is occupied, cannot delete.");
            }
        } else {
            System.out.println("Slot not found.");
        }
    }

    /**
     * Lists all the parking slots with their details.
     */
    public void listAllSlots() {
        for (ParkingSlot slot : slots) {
            System.out.println(slot);
        }
    }

    /**
     * Deletes all unoccupied parking slots.
     */
    public void deleteAllUnoccupiedSlots() {
        slots.removeIf(slot -> !slot.isOccupied());
        System.out.println("All unoccupied slots deleted.");
    }

    /**
     * Parks a car in a specified slot if it meets the criteria.
     * @param slotID The ID of the slot.
     * @param car The Car object to park.
     */
    public void parkCar(String slotID, Car car) {
        ParkingSlot slot = getSlot(slotID);
        if (slot != null) {
            if (!slot.isOccupied()) {
                if (slot.isStaffSlot() == car.isStaff()) {
                    slot.parkCar(car);
                    System.out.println("Car parked successfully.");
                } else {
                    System.out.println("Car cannot be parked in this slot type.");
                }
            } else {
                System.out.println("Slot is already occupied.");
            }
        } else {
            System.out.println("Slot not found.");
        }
    }

    /**
     * Finds a car by its registration number and displays the slot and owner details.
     * @param regNo The registration number of the car.
     */
    public void findCar(String regNo) {
        for (ParkingSlot slot : slots) {
            if (slot.isOccupied() && slot.getCar().getRegistrationNumber().equals(regNo)) {
                System.out.println("Car found in slot: " + slot);
                return;
            }
        }
        System.out.println("Car not found.");
    }

    /**
     * Removes a car from a slot by its registration number.
     * @param regNo The registration number of the car.
     */
    public void removeCar(String regNo) {
        for (ParkingSlot slot : slots) {
            if (slot.isOccupied() && slot.getCar().getRegistrationNumber().equals(regNo)) {
                slot.removeCar();
                System.out.println("Car removed successfully.");
                return;
            }
        }
        System.out.println("Car not found.");
    }

    /**
     * Finds a slot by its ID.
     * @param slotID The ID of the slot to find.
     * @return The ParkingSlot object, or null if not found.
     */
    private ParkingSlot getSlot(String slotID) {
        for (ParkingSlot slot : slots) {
            if (slot.getSlotID().equals(slotID)) {
                return slot;
            }
        }
        return null;
    }
}
