package featuretest_api;

import java.io.File;
import java.io.FileNotFoundException;
import java.util.Scanner;
import java.util.regex.Matcher;
import java.util.regex.Pattern;

public class FeatureTest_API {

    public static void main(String[] args) {

        File file = new File(args[0]);
        String regex = args[1];
        int repetition_counter = Integer.parseInt(args[2]);
        int count = 0;

        StringBuilder fileString = new StringBuilder();
        try {
            Scanner myReader = new Scanner(file);
            while (myReader.hasNextLine()) {
                fileString.append("\n").append(myReader.nextLine());
            }
            myReader.close();

        } catch (FileNotFoundException e) {
            e.toString();
        }

        Pattern pattern = Pattern.compile(regex);
        Matcher matcher = pattern.matcher(fileString);

        while (matcher.find()) {
            count++;
        }
        if (count >= repetition_counter) {
            System.out.print("true");
        } else {
            System.out.print("false");
        }
    }
}
