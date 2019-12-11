package indentation_api;

import java.io.*;
import java.util.*;

public class editText {

    public editText(String fileName) {
        ArrayList<String> records = new ArrayList<String>();
        ArrayList<String> newRecords = new ArrayList();
        readFile(fileName, records);
        editor(fileName, records, newRecords);
    }

    protected void readFile(String filename, ArrayList<String> records) {
        try {
            BufferedReader reader = new BufferedReader(new FileReader(filename));
            String line;
            while ((line = reader.readLine()) != null) {
                records.add(line);
            }
            reader.close();

        } catch (Exception e) {
            System.err.format("Exception occurred trying to read '%s'.", filename);
            e.printStackTrace();
        }
    }

    public void editor(String filename, ArrayList<String> records, ArrayList<String> newRecords) {

        Map<Integer, Integer> map = new HashMap();
        int numKey = 0;
        for (int x = 0, num3 = 0, num2 = 0; x < 20; x++) {
            map.put(num3 += 3, num2 += 2);
        }

        for (String line : records) {

            line = line.replaceAll("\t", "  ");
            if (checkSpaces(line) != 6 && map.containsKey(checkSpaces(line))) {
                numKey = map.get(checkSpaces(line));
                newRecords.add(Rewrite(line, numKey));
            } else {
                newRecords.add(line);
            }
        }
        saveFile(filename,newRecords);
    }

    public static int checkSpaces(String line) {

        int strCount = line.length();
        String ltrim = line.replaceAll("^\\s+", "");
        int numSpaces = (strCount - ltrim.length());
        return numSpaces;
    }

    public static String Rewrite(String line, int numSpaces) {

        String strSpaces = "";
        for (int x = 0; x < numSpaces; x++) {
            strSpaces += " ";
        }
        String ltrim = line.replaceAll("^\\s+", strSpaces);
        return ltrim;
    }

    private boolean saveFile(String fileName, List<String> lines) {
        File file = new File(fileName);
        try {
            FileWriter fw = new FileWriter(file.getAbsoluteFile());
            BufferedWriter bw = new BufferedWriter(fw);

            for (String str : lines) {
                bw.write(str + "\n");
            }
            bw.close();
        } catch (IOException e) {
            e.printStackTrace();
        }
        return false;
    }

}
