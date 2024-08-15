/**
 * The program has a class that generates a random number and can do string operations on a phrase 
 * 
 * @author : Arun Ragavendhar Arunachalam Palaniyappan - 104837257
 * @version  : 1.00 - Lab 3 - 13/08/2024
 */

import java.util.Random;
import java.util.Scanner;

public class RandomNumGenerator {

    public static void main(String args[]) {

        //Scanner object to read user input
        Scanner sc = new Scanner(System.in);

        //Random object to generate random numbers
        Random random = new Random();

        System.out.println("Hi, please enter an integer");

        // Reading the integer input from the user
        int num = sc.nextInt();
        
        /*
        we need to consume the leftover newline character from the input buffer , 
        before we can use the scanner object again 
         */ 
        sc.nextLine();

        System.out.println("You have entered: " + num +"\n");

        System.out.println("A random number between 20 and 40 is gonna be generated");

        // Generating a random integer between 20 and 40
        int randomNum = random.nextInt(20, 40);

        System.out.println("Random number generated: " + randomNum +"\n");

        // Variable to store the difference between the numbers
        int difference;

        // Using a if -else if - else block to check the entered number with the generated random number
        if (num < randomNum) {
            // If the entered number is smaller
            difference = randomNum - num;
            System.out.println("The smaller number is : " + num);
        } else if (num > randomNum) {
            // If the entered number is larger
            difference = num - randomNum;
            System.out.println("The smaller number is :" + randomNum);
        } else {
            // If both numbers are equal
            difference = num - randomNum;
            System.out.println("Both the numbers are equal");
        }

        // Displaying the difference between the entered number and the random number
        System.out.println("The difference between the numbers: " + difference +"\n");

        System.out.println("Please enter a sentence which has the word 'like'");

        // Reading the sentence from the user
        String sentence = sc.nextLine();

        // Replacing all occurrences of 'like' with 'dislike' in the sentence
        sentence = sentence.replace(" like ", " dislike ");
        // Converting the entire sentence to uppercase
        sentence = sentence.toUpperCase();

        // Final Display of the altered sentence
        System.out.println("\nThe sentence was altered where the word 'like' was replaced with 'dislike' \n and all the letters where converted to uppercase\n");
        System.out.println(sentence+"\n");

        // Closing the scanner object as its usage is over.
        sc.close();
    }
}