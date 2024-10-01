import java.util.ArrayList;

/**
 * The Tester class contains the main method to test the Student and Teacher classes.
 * @author : Arun Ragavendhar Arunachalam Palaniyappan
 * @Lab8 : 29/09/2024 
 */
public class Tester {
    public static void main(String[] args) {
        // Creating Student objects
        Student student1 = new Student("Alice", "Johnson", "S123", "Computer Science", "Charles Brown");
        Student student2 = new Student("Bob", "Williams", "S456", "Mathematics", "Diana Evans");

        // Creating Teacher objects
        Teacher teacher1 = new Teacher("Charles", "Brown", "Computer Science", 55000);
        Teacher teacher2 = new Teacher("Diana", "Evans", "Mathematics", 62000);

        // Storing students and teachers in an ArrayList
        ArrayList<Person> people = new ArrayList<>();
        people.add(student1);
        people.add(student2);
        people.add(teacher1);
        people.add(teacher2);

        // Using a loop to display the details of each person
        for (Person person : people) {
            person.displayDetails();
            System.out.println("-----------------------------");
        }
    }
}
