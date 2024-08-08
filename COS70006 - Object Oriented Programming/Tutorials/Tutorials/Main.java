
/**
 * The program has a class that converts Australian dollors to South African Rand and Vice versa
 * 
 * @author : Arun Ragavendhar Arunachalam Palaniyappan
 * @version  : Lab 2 - 06/08/2024
 */

import java.util.Scanner;
class CurrencyConverter
{
    private final double zarExchangeRate = 9.91;
    private double AUD;
    private double ZAR;
    
    void ZARtoAUD(double ZAR){
        this.ZAR = ZAR;
        this.AUD = this.ZAR / zarExchangeRate ;
        System.out.println("ZAR : "+this.ZAR+" is worth AUD : "+this.AUD);
    }
    
    void AUDtoZAR(double AUD){
        this.AUD = AUD;
        this.ZAR = this.AUD * zarExchangeRate ;
        System.out.println( "AUD : "+this.AUD+" is worth to ZAR : "+this.ZAR);
    }
}

public class Main{

    public static void main(String args[]){
        Scanner sc = new Scanner(System.in);
        char playAgain;
        CurrencyConverter convert = new CurrencyConverter();
        
        do{
            System.out.println("Hi , please enter '1' for AUD to ZAR and '2' for ZAR to AUD");
            int choice = sc.nextInt();
                if(choice == 1){
                    System.out.println("Please enter the AUD amount : ");
                    convert.AUDtoZAR(sc.nextInt());
                
                }
                else if(choice == 2){
                    System.out.println("Please enter the ZAR amount : ");
                    convert.ZARtoAUD(sc.nextInt());
                
                }
                else{
                    System.out.println("Invalid choice !. Please try again !");
                } 
            System.out.println("To continue using the program press y or Y");
            playAgain = sc.next().charAt(0);
        }while(playAgain == 'y' || playAgain == 'Y');
        
    }
}

