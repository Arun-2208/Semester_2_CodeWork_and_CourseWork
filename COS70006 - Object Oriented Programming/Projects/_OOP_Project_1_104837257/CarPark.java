import java.util.ArrayList;
import java.util.List;

/**
 * The CarPark class manages a collection of parking slots.
 * It allows for adding, deleting, listing, and finding slots and cars.
 * @author - Arun Ragavendhar - 104837257
 * @version - 1.0 - 06/09/2024
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
        // Allocating staff slots
        for (int i = 1; i <= staffSlots; i++) {
            slots.add(new ParkingSlot(staffIdentifier + String.format("%02d", i), true));
        }
        // Allocating visitor slots
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
            System.out.println("\nSlot added successfully.");
        } else {
            System.out.println("\nSlot ID already exists.");
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
                System.out.println("\nSlot deleted successfully.");
            } else {
                System.out.println("\nSlot is occupied, cannot delete.");
            }
        } else {
            System.out.println("\nSlot not found.");
        }
    }

    /**
     * Lists all the parking slots with their details.
     */
    public void listAllSlots() {
        if (slots.isEmpty()) {
            System.out.println("\nNo parking slots available.");
        } else {
            for (ParkingSlot slot : slots) {
                System.out.println("-----------------------------------------------");
                System.out.println(slot);
            }
        }
    }

    /**
     * Deletes all unoccupied parking slots.
     */
    public void deleteAllUnoccupiedSlots() {
        slots.removeIf(slot -> !slot.isOccupied());
        System.out.println("\nAll unoccupied slots deleted.");
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
                    System.out.println("\nCar parked successfully.");
                    updateSlot(slot);  // Ensure the slot is updated in the list
                } else {
                    System.out.println("\nCar cannot be parked in this slot type.");
                }
            } else {
                System.out.println("\nSlot is already occupied.");
            }
        } else {
            System.out.println("\nSlot not found.");
        }
    }

    /**
     * Finds a car by its registration number and displays the slot and owner details.
     * @param regNo The registration number of the car.
     */
    public void findCar(String regNo) {
        for (ParkingSlot slot : slots) {
            if (slot.isOccupied() && slot.getCar().getRegistrationNumber().equals(regNo)) {
                System.out.println("\nCar found in slot: " + slot);
                return;
            }
        }
        System.out.println("\nCar not found.");
    }

    /**
     * Removes a car from a slot by its registration number.
     * @param regNo The registration number of the car.
     */
    public void removeCar(String regNo) {
        for (ParkingSlot slot : slots) {
            if (slot.isOccupied() && slot.getCar().getRegistrationNumber().equals(regNo)) {
                slot.removeCar();
                System.out.println("\nCar removed successfully.");
                return;
            }
        }
        System.out.println("\nCar not found.");
    }

    /**
     * Finds a slot by its ID.
     * @param slotID The ID of the slot to find.
     * @return The ParkingSlot object, or null if not found.
     */
    public ParkingSlot getSlot(String slotID) {
        for (ParkingSlot slot : slots) {
            if (slot.getSlotID().equals(slotID)) {
                return slot;
            }
        }
        return null;
    }

    /**
     * Updates an existing slot in the list after modification.
     * @param updatedSlot The updated ParkingSlot object.
     */
    private void updateSlot(ParkingSlot updatedSlot) {
        for (int i = 0; i < slots.size(); i++) {
            if (slots.get(i).getSlotID().equals(updatedSlot.getSlotID())) {
                slots.set(i, updatedSlot);
                break;
            }
        }
    }

    /**
     * Checks if a slot ID is unique.
     * @param slotID The slot ID to check.
     * @return True if the slot ID is unique, false otherwise.
     */
    public boolean isSlotIDUnique(String slotID) {
        return getSlot(slotID) == null;
    }

    /**
     * Checks if a slot is available for parking a car.
     * @param slotID The ID of the slot.
     * @param isStaff True if the car is for a staff member, false if it's for a visitor.
     * @return True if the slot is available, false otherwise.
     */
    public boolean isSlotAvailable(String slotID, boolean isStaff) {
        ParkingSlot slot = getSlot(slotID);
        if (slot == null) {
            System.out.println("\nSlot not found.");
            return false;
        }
        if (slot.isOccupied()) {
            System.out.println("\nSlot is already occupied.");
            return false;
        }
        if (slot.isStaffSlot() != isStaff) {
            System.out.println("\nCar cannot be parked in this slot type.");
            return false;
        }
        return true;
    }

    /**
     * Checks if a slot is occupied.
     * @param slotID The ID of the slot to check.
     * @return True if the slot is occupied, false otherwise.
     */
    public boolean isSlotOccupied(String slotID) {
        ParkingSlot slot = getSlot(slotID);
        return slot != null && slot.isOccupied();
    }
}
