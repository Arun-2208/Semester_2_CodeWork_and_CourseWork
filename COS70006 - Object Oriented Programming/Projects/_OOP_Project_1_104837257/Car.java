import java.util.regex.Pattern;

/**
 * The Car class represents a car with a registration number and ownership details.
 * 
 * @author - Arun Ragavendhar - 104837257
 * @version - 1.0 - 06/09/2024
 */
public class Car {

    private String registrationNumber;
    private String owner;
    private boolean isStaff;
    private static final Pattern REG_NO_PATTERN = Pattern.compile("^[A-Z]\\d{4}$");

    /**
     * Initializes a Car object with a registration number, owner's name, and staff
     * status.
     * 
     * @param registrationNumber The car's registration number (e.g., "T2345").
     * @param owner              The name of the car's owner.
     * @param isStaff            True if the owner is a staff member, false
     *                           otherwise.
     * @throws IllegalArgumentException if the registration number is invalid.
     */
    public Car(String registrationNumber, String owner, boolean isStaff) {
        if (!REG_NO_PATTERN.matcher(registrationNumber).matches()) {
            throw new IllegalArgumentException("\nInvalid registration number. Must be an uppercase letter followed by 4 digits.");
        }
        this.registrationNumber = registrationNumber;
        this.owner = owner;
        this.isStaff = isStaff;
    }

    /**
     * Gets the registration number of the car.
     * 
     * @return The registration number.
     */
    public String getRegistrationNumber() {
        return registrationNumber;
    }

    /**
     * Gets the name of the car's owner.
     * 
     * @return The owner's name.
     */
    public String getOwner() {
        return owner;
    }

    /**
     * Checks if the owner is a staff member.
     * 
     * @return True if the owner is a staff member, false otherwise.
     */
    public boolean isStaff() {
        return isStaff;
    }

    /**
     * Provides a string representation of the car's details.
     * 
     * @return A formatted string with the car's registration number, owner's name,
     *         and staff status.
     */
    @Override
    public String toString() {
        return String.format("Registration: %s, Owner: %s, Owner type: %s", registrationNumber, owner, isStaff ? "staff" : "Visitor");
    }
}
