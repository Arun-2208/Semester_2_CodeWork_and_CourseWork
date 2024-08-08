
/**
 * The program has a class that converts Australian dollors to South African Rand and Vice versa
 * 
 * @author : Arun Ragavendhar Arunachalam Palaniyappan
 * @version  : 1.00 - Lab 2 - 06/08/2024
 */

import java.util.Scanner;

public class CurrencyConverter{

    // stores the exchange rate 
    static final double zarExchangeRate = 9.91;
    
    // stores the value of AUD 
    static double AUD;

    // Stores the value of ZAR
    static double ZAR;

    // method to convert ZAR to AUD 
    static double  ZARtoAUD(double ZAR){
        
        return ZAR / zarExchangeRate;
    }
    
    //Method to convert AUD to ZAR 
    static double  AUDtoZAR(double AUD){
        
        return AUD * zarExchangeRate; 
    }

    public static void main(String args[]){
        Scanner sc = new Scanner(System.in);
        char playAgain;
        
        
        do{
            System.out.println("Hi , please choose your option\n1.AUD to ZAR\n2.ZAR to AUD\n");
            int choice = sc.nextInt();
            // code for user choice == 1
                if(choice == 1){
                    System.out.println("Please enter the AUD amount : ");
                    System.out.println("Amount in ZAR: "+AUDtoZAR(sc.nextDouble()));
                
                }
            // code for user choice == 2    
                else if(choice == 2){
                    System.out.println("Please enter the ZAR amount : ");
                    System.out.println("Amount in AUD: "+ZARtoAUD(sc.nextDouble()));
                
                }
                else{
                    System.out.println("Invalid choice !. Please try again !");
                } 
            System.out.println("To continue using the program press y or Y");
            playAgain = sc.next().charAt(0);
        }while(playAgain == 'y' || playAgain == 'Y');
        
    }
}

