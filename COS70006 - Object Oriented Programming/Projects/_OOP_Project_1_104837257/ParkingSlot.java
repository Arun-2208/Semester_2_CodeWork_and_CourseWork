import java.time.Duration;
import java.time.LocalDateTime;
import java.time.format.DateTimeFormatter;
import java.util.regex.Pattern;

/**
 * The ParkingSlot class represents a parking slot in the car park.
 * It tracks whether the slot is occupied and holds information about the parked car.
 * @author - Arun Ragavendhar - 104837257
 * @version - 1.0 - 06/09/2024
 */
public class ParkingSlot {

    private String slotID;
    private boolean isStaffSlot;
    private Car car;
    private LocalDateTime parkedTime;
    private static final Pattern SLOT_ID_PATTERN = Pattern.compile("^[SV]\\d{2}$");

    /**
     * Initializes a ParkingSlot with an ID and type.
     * @param slotID The ID of the slot (e.g., "S01"). slot ID is starts with 'S' for staff and 'V' for visitor 
     * @param isStaffSlot True if it's a staff slot, false if it's a visitor slot.
     * @throws IllegalArgumentException if the slot ID is invalid.
     */
    public ParkingSlot(String slotID, boolean isStaffSlot) {
        if (!SLOT_ID_PATTERN.matcher(slotID).matches()) {
            throw new IllegalArgumentException("\nInvalid slot ID. Must be an uppercase letter followed by 2 digits.");
        }
        this.slotID = slotID;
        this.isStaffSlot = isStaffSlot;
    }

    /**
     * Gets the ID of the slot.
     * @return The slot ID.
     */
    public String getSlotID() {
        return slotID;
    }

    /**
     * Checks if the slot is for staff.
     * @return True if it's a staff slot, false otherwise.
     */
    public boolean isStaffSlot() {
        return isStaffSlot;
    }

    /**
     * Checks if the slot is occupied by a car.
     * @return True if the slot is occupied, false otherwise.
     */
    public boolean isOccupied() {
        return car != null;
    }

    /**
     * Gets the car parked in the slot.
     * @return The Car object, or null if the slot is empty.
     */
    public Car getCar() {
        return car;
    }

    /**
     * Parks a car in the slot and records the current time.
     * @param car The Car object to park.
     * @throws IllegalStateException if the slot is already occupied.
     */
    public void parkCar(Car car) {
        if (isOccupied()) {
            throw new IllegalStateException("\nSlot is already occupied.");
        }
        this.car = car;
        this.parkedTime = LocalDateTime.now();  // Record the current time when the car is parked 
    }

    /**
     * Removes the car from the slot and clears the parked time.
     * @throws IllegalStateException if the slot is already empty.
     */
    public void removeCar() {
        if (!isOccupied()) {
            throw new IllegalStateException("\nSlot is already empty.");
        }
        this.car = null;
        this.parkedTime = null;
    }

    /**
     * Provides a string representation of the slot's details, including the parked car if present.
     * @return A formatted string with slot and car details.
     */
    @Override
    public String toString() {
        StringBuilder sb = new StringBuilder();
        sb.append("Slot ID: ").append(slotID);
        sb.append(", Type: ").append(isStaffSlot ? "Staff" : "Visitor");
        sb.append(", Status: ").append(isOccupied()? "Occupied" :"Vacant").append("\n");
        if (isOccupied()) {
            sb.append("\nCar - ").append(car).append("\n");
            sb.append("\nParked Time: ").append(parkedTime.format(DateTimeFormatter.ofPattern("yyyy-MM-dd HH:mm:ss")));
            sb.append(", Parking Duration: ").append(getParkingDuration());
            sb.append(", Fee: $").append(calculateParkingFee());
        }
        return sb.toString();
    }

    /**
     * Calculates the duration the car has been parked.
     * @return A formatted string showing the duration.
     */
    private String getParkingDuration() {
        if (parkedTime == null) return "\nNot Applicable";
        Duration duration = Duration.between(parkedTime, LocalDateTime.now());
        long hours = duration.toHours();
        long minutes = duration.toMinutesPart();
        long seconds = duration.toSecondsPart();
        return String.format("%02d hours %02d minutes %02d seconds", hours, minutes, seconds);
    }

    /**
     * Calculates the parking fee based on the duration.
     * @return The parking fee in dollars.
     */
    private int calculateParkingFee() {
        if (parkedTime == null) return 0;
        long hours = Duration.between(parkedTime, LocalDateTime.now()).toHours();
        return (int) (hours + 1) * 5; // Charge for every hour , for less than 1 hour , minimum charge is taken for 1 hour as standard rate 
    }
}
