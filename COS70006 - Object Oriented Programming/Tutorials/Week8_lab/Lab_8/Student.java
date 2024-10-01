/**
 * The Student class represents a student, which is a subclass of Person.
 * @author : Arun Ragavendhar Arunachalam Palaniyappan
 * @Lab8 : 29/09/2024 
 */
public class Student extends Person {
    private String studentId;
    private String course;
    private String teacherName;

    /**
     * Constructor to initialize a student with first and last name,
     * student ID, course, and teacher name.
     * @param firstName the first name of the student
     * @param lastName the last name of the student
     * @param studentId the student ID
     * @param course the course the student is enrolled in
     * @param teacherName the name of the teacher
     */
    public Student(String firstName, String lastName, String studentId, String course, String teacherName) {
        super(firstName, lastName);
        this.studentId = studentId;
        this.course = course;
        this.teacherName = teacherName;
    }

    /**
     * Displays the details of the student, including personal details
     * and student-specific information.
     */
    @Override
    public void displayDetails() {
        super.displayDetails();
        System.out.println("Student ID: " + studentId);
        System.out.println("Course: " + course);
        System.out.println("Teacher Name: " + teacherName);
    }
}
