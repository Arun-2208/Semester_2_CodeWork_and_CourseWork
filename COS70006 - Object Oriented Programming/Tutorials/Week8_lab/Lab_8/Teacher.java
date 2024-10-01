/**
 * The Teacher class represents a teacher, which is a subclass of Person.
 * @author : Arun Ragavendhar Arunachalam Palaniyappan
 * @Lab8 : 29/09/2024 
 */
public class Teacher extends Person {
    private String subjectName;
    private double salary;

    /**
     * Constructor to initialize a teacher with first and last name,
     * subject name, and salary.
     * @param firstName the first name of the teacher
     * @param lastName the last name of the teacher
     * @param subjectName the subject the teacher teaches
     * @param salary the salary of the teacher
     */
    public Teacher(String firstName, String lastName, String subjectName, double salary) {
        super(firstName, lastName);
        this.subjectName = subjectName;
        this.salary = salary;
    }

    /**
     * Displays the details of the teacher, including personal details
     * and teacher-specific information.
     */
    @Override
    public void displayDetails() {
        super.displayDetails();
        System.out.println("Subject Name: " + subjectName);
        System.out.println("Salary: " + salary);
    }
}
