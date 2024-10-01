/**
 * The Person class represents a person with a first and last name.
 * @author : Arun Ragavendhar Arunachalam Palaniyappan
 * @Lab8 : 29/09/2024 
 */
public class Person {
    private String firstName;
    private String lastName;

    /**
     * Constructor to initialize the person's first and last name.
     * @param firstName the first name of the person
     * @param lastName the last name of the person
     */
    public Person(String firstName, String lastName) {
        this.firstName = firstName;
        this.lastName = lastName;
    }

    // Accessor methods
    public String getFirstName() {
        return firstName;
    }

    public void setFirstName(String firstName) {
        this.firstName = firstName;
    }

    public String getLastName() {
        return lastName;
    }

    public void setLastName(String lastName) {
        this.lastName = lastName;
    }

    /**
     * Displays the details of the person.
     */
    public void displayDetails() {
        System.out.println("Name: " + firstName + " " + lastName);
    }
}
