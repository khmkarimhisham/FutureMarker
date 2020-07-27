package data;

public class FeatureTest {

    private String name;
    private String regex;
    private int repetition;

    public FeatureTest(String name, String regex, int Repetition) {
        this.name = name;
        this.regex = regex;
        this.repetition = Repetition;
    }

    public String getName() {
        return name;
    }

    public String getRegex() {
        return regex;
    }

    public int getRepetition() {
        return repetition;
    }

}
