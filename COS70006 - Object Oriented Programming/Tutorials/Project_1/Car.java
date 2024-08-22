/**
 * The Car class represents a car with a registration number and ownership details.
 */
public class Car {

    private String registrationNumber;
    private String owner;
    private boolean isStaff;

    /**
     * Initializes a Car object with a registration number, owner's name, and staff status.
     * @param registrationNumber The car's registration number (e.g., "T2345").
     * @param owner The name of the car's owner.
     * @param isStaff True if the owner is a staff member, false otherwise.
     */
    public Car(String registrationNumber, String owner, boolean isStaff) {
        this.registrationNumber = registrationNumber;
        this.owner = owner;
        this.isStaff = isStaff;
    }

    /**
     * Gets the registration number of the car.
     * @return The registration number.
     */
    public String getRegistrationNumber() {
        return registrationNumber;
    }

    /**
     * Gets the name of the car's owner.
     * @return The owner's name.
     */
    public String getOwner() {
        return owner;
    }

    /**
     * Checks if the owner is a staff member.
     * @return True if the owner is a staff member, false otherwise.
     */
    public boolean isStaff() {
        return isStaff;
    }

    /**
     * Provides a string representation of the car's details.
     * @return A formatted string with the car's registration number, owner's name, and staff status.
     */
    @Override
    public String toString() {
        return "Registration: " + registrationNumber + ", Owner: " + owner + ", Staff: " + isStaff;
    }
}
