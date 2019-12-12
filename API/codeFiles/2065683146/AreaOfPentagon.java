import java.util.Scanner;

public class AreaOfPentagon {
    public static void main(String[] args) {
        double r, area, s;
        final double PI = 3.14; // Constant
        // Prompt the user to enter the length of a side
        System.out.println("Enter the length of a side : ");
        Scanner input = new Scanner(System.in); // Create a scanner
        r = input.nextDouble();
        // Compute the length of a side
        s = 2 * r * (Math.sin(PI / 5));
        // Compute the area of a pentagon
        area = (5 * s * s) / (4 * Math.tan(PI / 5));
        System.out.println("Area of pentagon is " + area);
    }
}