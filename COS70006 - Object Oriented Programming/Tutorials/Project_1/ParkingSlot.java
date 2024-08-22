import java.time.Duration;
import java.time.LocalDateTime;
import java.time.format.DateTimeFormatter;

/**
 * The ParkingSlot class represents a parking slot in the car park.
 * It tracks whether the slot is occupied and holds information about the parked car.
 */
public class ParkingSlot {

    private String slotID;
    private boolean isStaffSlot;
    private Car car;
    private LocalDateTime parkedTime;

    /**
     * Initializes a ParkingSlot with an ID and type.
     * @param slotID The ID of the slot (e.g., "S01").
     * @param isStaffSlot True if it's a staff slot, false if it's a visitor slot.
     */
    public ParkingSlot(String slotID, boolean isStaffSlot) {
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
     */
    public void parkCar(Car car) {
        this.car = car;
        this.parkedTime = LocalDateTime.now();
    }

    /**
     * Removes the car from the slot and clears the parked time.
     */
    public void removeCar() {
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
        sb.append(", Occupied: ").append(isOccupied());
        if (isOccupied()) {
            sb.append(", Car: ").append(car);
            sb.append(", Parked Time: ").append(parkedTime.format(DateTimeFormatter.ofPattern("yyyy-MM-dd HH:mm:ss")));
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
        if (parkedTime == null) return "N/A";
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
        return (int) (hours + 1) * 5; // Charge for every hour or part thereof
    }
}
